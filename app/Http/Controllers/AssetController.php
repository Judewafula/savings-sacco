<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    // Display all assets
    public function index()
    {
        $assets = Asset::all();
        return view('assets.index', compact('assets'));
    }

    // Show the form for creating a new asset
    public function create()
    {
        return view('assets.create');
    }

    // Store a newly created asset
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',              // Cost price
            'date_recorded' => 'required|date',
            'asset_description' => 'nullable|string',
            'color_of_asset' => 'nullable|string|max:255',
            'price' => 'required|numeric',              // Selling price
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if asset already exists (optional)
        $existingAsset = Asset::where('name', $validatedData['name'])
            ->where('value', $validatedData['value'])
            ->where('date_recorded', $validatedData['date_recorded'])
            ->first();

        if ($existingAsset) {
            return redirect()->back()->withErrors(['error' => 'Asset already exists.']);
        }

        // Create new asset
        $asset = new Asset();
        $asset->name = $validatedData['name'];
        $asset->value = $validatedData['value'];
        $asset->date_recorded = $validatedData['date_recorded'];
        $asset->asset_description = $validatedData['asset_description'] ?? null;
        $asset->color_of_asset = $validatedData['color_of_asset'] ?? null;
        $asset->price = $validatedData['price'];
        $asset->total_quantity = $validatedData['quantity'];
        $asset->available_quantity = $validatedData['quantity'];  // initial available quantity = total
        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Asset created successfully!');
    }

    // Show the form for editing the specified asset
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        return view('assets.edit', compact('asset'));
    }

    // Update the specified asset
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'date_recorded' => 'nullable|date',
            'asset_description' => 'nullable|string',
            'color_of_asset' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        $asset = Asset::findOrFail($id);

        // Handle stock quantities properly
        if ($validatedData['quantity'] > $asset->total_quantity) {
            // Increase in total quantity, increase available quantity accordingly
            $diff = $validatedData['quantity'] - $asset->total_quantity;
            $asset->available_quantity += $diff;
        } elseif ($validatedData['quantity'] < $asset->total_quantity) {
            // If total quantity is reduced, make sure available_quantity doesn't go negative
            $diff = $asset->total_quantity - $validatedData['quantity'];
            $asset->available_quantity = max(0, $asset->available_quantity - $diff);
        }

        $asset->update([
            'name' => $validatedData['name'],
            'value' => $validatedData['value'],
            'date_recorded' => $validatedData['date_recorded'],
            'asset_description' => $validatedData['asset_description'] ?? null,
            'color_of_asset' => $validatedData['color_of_asset'] ?? null,
            'price' => $validatedData['price'],
            'total_quantity' => $validatedData['quantity'],
            'available_quantity' => $asset->available_quantity,
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    // Delete the specified asset
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }

    // Optional: Select asset for further action
    public function select($id)
    {
        $asset = Asset::findOrFail($id);
        return view('assets.select', compact('asset'));
    }

    // Optional: Confirm selection of asset
    public function confirmSelection(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);
        return redirect()->route('assets.index')->with('success', 'Asset selected successfully.');
    }

    public function dashboard()
    {
        $assets = Asset::all();
        return view('assets.dashboard', compact('assets'));
    }
}
