<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    // Show the sales listing page
    public function index()
    {
        $sales = Sale::with('asset', 'user')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    // Show the form to create a new sale
    public function create(Request $request)
    {
        if ($request->has('asset_id')) {
            $asset = Asset::findOrFail($request->asset_id);
            return view('sales.create', compact('asset'));
        } else {
            $assets = Asset::all();
            return view('sales.create', compact('assets'));
        }
    }

    // Store a new sale
    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $asset = Asset::findOrFail($request->asset_id);

        // ✅ Calculate available stock dynamically
        $availableStock = $asset->total_quantity - $asset->sold_quantity;

        if ($request->quantity > $availableStock) {
            return redirect()->back()->with('error', 'Not enough quantity in stock');
        }

        // ✅ Update sold_quantity
        $asset->sold_quantity += $request->quantity;
        $asset->save();

        // ✅ Save the sale
        Sale::create([
            'asset_id'    => $asset->id,
            'quantity'    => $request->quantity,
            'user_id'     => Auth::id(),
            'sale_date'   => now(),
            'price'       => $asset->price, // unit selling price
            'total_price' => $asset->price * $request->quantity,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sale placed successfully');
    }

    // Optional: Show all assets
    public function showAssetPage()
    {
        $assets = Asset::all();
        return view('assets.index', compact('assets'));
    }

    // Optional: Show sales listing
    public function showSalesPage()
    {
        return $this->index();
    }
}
