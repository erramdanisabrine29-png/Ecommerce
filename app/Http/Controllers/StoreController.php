<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class StoreController extends Controller
{
    /**
     * Display a listing of the authenticated user's stores.
     */
    public function applications(Store $store)
{
    return view('stores.applications', compact('store'));
}

public function shopifyConfig(Store $store)
{
    return view('stores.shopify', compact('store'));
}

public function generateWebhook(Store $store)
{
    if (!$store->webhook_secret) {

        $store->webhook_secret = Str::random(64);
        $store->webhook_token = Str::random(32);
        $store->save();
    }

    return redirect()->route('stores.shopify.config', $store->id);
}

    public function index()
    {
        $stores = Store::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new store.
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created store in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|unique:stores,url',
            'ssl_certificate_status' => 'required|in:active,inactive,expired,pending',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'minimum_stock' => 'required|integer|min:1',
            'api_key' => 'nullable|string|unique:stores,api_key',
        ]);

        // Generate API key if not provided
        if (empty($validated['api_key'])) {
            $validated['api_key'] = Store::generateUniqueApiKey();
        }

        $validated['user_id'] = Auth::id();
        $store = Store::create($validated);

        return redirect()->route('stores.show', $store)
            ->with('success', 'Magasin créé avec succès.');
    }

    /**
     * Display the specified store.
     */
    public function show(Store $store)
    {
        if ($store->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this store.');
        }
        return view('stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified store.
     */
    public function edit(Store $store)
    {
        if ($store->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this store.');
        }
        return view('stores.edit', compact('store'));
    }

    /**
     * Update the specified store.
     */
    public function update(Request $request, Store $store)
    {
        if ($store->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this store.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|unique:stores,url,' . $store->id,
            'ssl_certificate_status' => 'required|in:active,inactive,expired,pending',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'minimum_stock' => 'required|integer|min:1',
        ]);

        $store->update($validated);

        return redirect()->route('stores.show', $store)
            ->with('success', 'Magasin mis à jour avec succès.');
    }

    /**
     * Delete the specified store.
     */
    public function destroy(Store $store)
    {
        if ($store->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this store.');
        }
        $name = $store->name;
        $store->delete();

        return redirect()->route('stores.index')
            ->with('success', "Magasin '{$name}' supprimé avec succès.");
    }

    /**
     * Regenerate API key for the specified store.
     */
    public function regenerateApiKey(Store $store)
    {
        if ($store->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this store.');
        }

        $store->update([
            'api_key' => Store::generateUniqueApiKey(),
        ]);

        return redirect()->route('stores.show', $store)
            ->with('success', 'Clé API régénérée avec succès.');
    }

    /**
     * Get store details as JSON (for AJAX).
     */
    public function getJson(Store $store)
    {
        if ($store->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this store.');
        }

        return response()->json([
            'id' => $store->id,
            'name' => $store->name,
            'url' => $store->url,
            'api_key' => $store->api_key,
            'ssl_certificate_status' => $store->ssl_certificate_status,
            'tax_rate' => $store->tax_rate,
            'minimum_stock' => $store->minimum_stock,
        ]);
    }
}
