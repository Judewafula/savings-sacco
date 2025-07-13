<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;  // Make sure the model name is correct and capitalized

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all assets with their quantities
        $assets = Asset::all();

        // Pass assets data to the dashboard view
        return view('assets.dashboard', compact('assets'));
    }

    public function create()
    {
        return view('assets.create');  // Fixed view name and removed extra '$'
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
        ]);

        // Create and save a new asset
        $asset = new Asset();
        $asset->name = $validatedData['name'];
        $asset->value = $validatedData['value'];
        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Asset created successfully!');
    }
}
