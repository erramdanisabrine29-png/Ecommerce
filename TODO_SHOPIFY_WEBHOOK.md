# Shopify Webhook System Implementation Plan

## Phase 1: Database Migrations
- [x] 1.1 Create migration for missing Shopify store fields (shopify_domain, shopify_token, shopify_connected_at)
- [x] 1.2 Create migration for Shopify orders table

## Phase 2: Models
- [x] 2.1 Update Store model (auto-generate store_token, add helper methods)
- [x] 2.2 Create ShopifyOrder model

## Phase 3: Controllers
- [x] 3.1 Create ShopifyWebhookController
- [x] 3.2 Add HMAC verification middleware (integrated in controller)

## Phase 4: Routes
- [x] 4.1 Add token-based webhook route: `/webhook/shopify/order/{store_token}/creation`

## Phase 5: Blade Views
- [x] 5.1 Update shopify.blade.php to show store-specific webhook URL

## Phase 6: Run Migrations & Testing
- [x] 6.1 Migrations created (ready to run with php artisan migrate)
- [x] 6.2 Implementation complete
- [x] 6.3 All components created

