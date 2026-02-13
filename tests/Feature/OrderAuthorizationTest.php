<?php

use App\Models\Customer;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Site;
use App\Models\User;

beforeEach(function () {
    // nothing for now
});

it('prevents a merchant from accessing another merchant\'s order (policy + HTTP)', function () {
    $merchantAUser = User::factory()->create();
    $merchantAUser->assignRole('Merchant');
    $merchantAModel = Merchant::create(['user_id' => $merchantAUser->id, 'company_name' => 'A']);
    $siteA = Site::create(['id_merchant' => $merchantAModel->id_merchant]);

    $merchantBUser = User::factory()->create();
    $merchantBUser->assignRole('Merchant');
    $merchantBModel = Merchant::create(['user_id' => $merchantBUser->id, 'company_name' => 'B']);
    $siteB = Site::create(['id_merchant' => $merchantBModel->id_merchant]);

    $customer = Customer::create(['user_id' => $merchantBUser->id, 'first_name_customer' => 'C', 'email' => 'c@example.com']);

    $orderB = Order::create([
        'id_site' => $siteB->id_site,
        'id_customer' => $customer->id_customer,
        'reference' => 'ORD-TST-B',
        'order_status' => 'pending',
        'shipping_amount' => 0,
        'discount' => 0,
        'total_amount' => 100,
    ]);

    // merchantA should be blocked from viewing merchantB's order (policy -> HTTP should return 403)
    $this->actingAs($merchantAUser)
        ->getJson(route('api.orders.show', $orderB))
        ->assertStatus(403);
});

it('counts only pending merchant-visible orders for the badge', function () {
    $merchantUser = User::factory()->create();
    $merchantUser->assignRole('Merchant');
    // ensure spatie caches are fresh for view-layer role checks
    app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    $merchantUser = $merchantUser->fresh();
    $merchantModel = Merchant::create(['user_id' => $merchantUser->id, 'company_name' => 'BadgeCo']);
    $site = Site::create(['id_merchant' => $merchantModel->id_merchant]);

    $customer = Customer::create(['user_id' => $merchantUser->id, 'first_name_customer' => 'B', 'email' => 'b@example.com']);

    // create orders with different statuses
    Order::create(['id_site' => $site->id_site, 'id_customer' => $customer->id_customer, 'reference' => 'ORD-1', 'order_status' => 'pending', 'shipping_amount' => 0, 'discount' => 0, 'total_amount' => 10]);
    Order::create(['id_site' => $site->id_site, 'id_customer' => $customer->id_customer, 'reference' => 'ORD-2', 'order_status' => 'confirmed', 'shipping_amount' => 0, 'discount' => 0, 'total_amount' => 20]);
    Order::create(['id_site' => $site->id_site, 'id_customer' => $customer->id_customer, 'reference' => 'ORD-3', 'order_status' => 'pending', 'shipping_amount' => 0, 'discount' => 0, 'total_amount' => 30]);
    Order::create(['id_site' => $site->id_site, 'id_customer' => $customer->id_customer, 'reference' => 'ORD-4', 'order_status' => 'delivered', 'shipping_amount' => 0, 'discount' => 0, 'total_amount' => 40]);

    // The badge should count only pending orders (2 in this setup)
    expect(\App\Models\Order::countForMerchant($merchantUser->id))->toBe(2);

    // and when asking explicitly for multiple statuses, it respects the filter
    expect(\App\Models\Order::countForMerchant($merchantUser->id, ['pending', 'confirmed']))->toBe(3);
});

it('shows pending orders count in header tooltip and badge (web)', function () {
    $merchantUser = User::factory()->create();
    $merchantUser->assignRole('Merchant');
    app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    $merchantUser = $merchantUser->fresh();
    $merchantModel = Merchant::create(['user_id' => $merchantUser->id, 'company_name' => 'UIBadge']);
    $site = Site::create(['id_merchant' => $merchantModel->id_merchant]);

    $customer = Customer::create(['user_id' => $merchantUser->id, 'first_name_customer' => 'U', 'email' => 'u@example.com']);

    Order::create(['id_site' => $site->id_site, 'id_customer' => $customer->id_customer, 'reference' => 'ORD-U1', 'order_status' => 'pending', 'shipping_amount' => 0, 'discount' => 0, 'total_amount' => 10]);
    Order::create(['id_site' => $site->id_site, 'id_customer' => $customer->id_customer, 'reference' => 'ORD-U2', 'order_status' => 'confirmed', 'shipping_amount' => 0, 'discount' => 0, 'total_amount' => 20]);

    $resp = $this->actingAs($merchantUser)->get(route('orders.index'));
    $resp->assertStatus(200);

    // header should include the pending-orders badge (1)
    $resp->assertSee('aria-label="1 pending orders"', false);
});

it('navigates from dashboard to orders page via My orders link (web)', function () {
    $merchantUser = User::factory()->create();
    $merchantUser->assignRole('Merchant');

    // Dashboard contains the My orders link
    $dash = $this->actingAs($merchantUser)->get(route('dashboard'));
    $dash->assertStatus(200);
    $dash->assertSee('My orders');
    $dash->assertSee(route('orders.index'));

    // Follow the link (server-side) and ensure orders.index renders
    $ordersPage = $this->actingAs($merchantUser)->get(route('orders.index'));
    $ordersPage->assertStatus(200);
    $ordersPage->assertSeeText('Orders');
});

it('prevents a client (regular user) from deleting an order but allows viewing own order via policy', function () {
    $client = User::factory()->create(['role' => 'client']);

    $merchantUser = User::factory()->create();
    $merchantUser->assignRole('Merchant');
    $merchantModel = Merchant::create(['user_id' => $merchantUser->id, 'company_name' => 'M']);
    $site = Site::create(['id_merchant' => $merchantModel->id_merchant]);

    $customer = Customer::create(['user_id' => $client->id, 'first_name_customer' => 'Client', 'email' => 'client@example.com']);

    $order = Order::create([
        'id_site' => $site->id_site,
        'id_customer' => $customer->id_customer,
        'reference' => 'ORD-CLIENT',
        'order_status' => 'pending',
        'shipping_amount' => 0,
        'discount' => 0,
        'total_amount' => 10,
    ]);

    // Policy assertions (direct): client can view own order but cannot delete
    expect($client->can('view', $order))->toBeTrue();
    expect($client->can('delete', $order))->toBeFalse();
});

it('allows Administrator to access all orders (policy)', function () {
    $admin = User::factory()->create();
    $admin->assignRole('Administrator');

    $merchantUser = User::factory()->create();
    $merchantUser->assignRole('Merchant');
    $merchantModel = Merchant::create(['user_id' => $merchantUser->id, 'company_name' => 'M2']);
    $site = Site::create(['id_merchant' => $merchantModel->id_merchant]);

    $customer = Customer::create(['user_id' => $merchantUser->id, 'first_name_customer' => 'Cust', 'email' => 'cust@example.com']);

    $order = Order::create([
        'id_site' => $site->id_site,
        'id_customer' => $customer->id_customer,
        'reference' => 'ORD-ADMIN',
        'order_status' => 'pending',
        'shipping_amount' => 0,
        'discount' => 0,
        'total_amount' => 50,
    ]);

    expect($admin->can('view', $order))->toBeTrue();
    expect($admin->can('delete', $order))->toBeTrue();
});

it('prevents updating orders that are delivered/cancelled/returned', function () {
    $merchantUser = User::factory()->create();
    $merchantUser->assignRole('Merchant');
    $merchantModel = Merchant::create(['user_id' => $merchantUser->id, 'company_name' => 'M3']);
    $site = Site::create(['id_merchant' => $merchantModel->id_merchant]);

    $customer = Customer::create(['user_id' => $merchantUser->id, 'first_name_customer' => 'X', 'email' => 'x@example.com']);

    $deliveredOrder = Order::create([
        'id_site' => $site->id_site,
        'id_customer' => $customer->id_customer,
        'reference' => 'ORD-DELIV',
        'order_status' => 'delivered',
        'shipping_amount' => 0,
        'discount' => 0,
        'total_amount' => 20,
    ]);

    // Policy must deny updates for final statuses (even for merchant)
    expect($merchantUser->can('update', $deliveredOrder))->toBeFalse();
    // Admin also cannot update final-status orders per requirement
    $admin = User::factory()->create();
    $admin->assignRole('Administrator');
    expect($admin->can('update', $deliveredOrder))->toBeFalse();
});
