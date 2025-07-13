@extends('layouts.app')

@section('content')
<div class="container">
    
    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>Assets in Stock</h1>

    @if ($assets->isEmpty())
        <p>No assets found.</p>
    @else  
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Date Recorded</th>
                    <th>Description</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Available Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assets as $asset)
                    <tr>
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>UGX {{ number_format($asset->value) }}</td>
                        <td>{{ $asset->date_recorded }}</td>
                        <td>{{ $asset->asset_description }}</td>
                        <td>{{ $asset->color_of_asset }}</td>
                        <td>UGX {{ number_format($asset->price) }}</td>
                        <td>{{ $asset->available_quantity }}</td>
                        <td>
                            {{-- Edit button --}}
                            <a href="{{ route('assets.edit', $asset->id) }}" 
                               class="btn btn-primary btn-sm mb-1" 
                               onclick="return confirm('Are you sure you want to edit this asset?')">
                               Edit
                            </a>

                            {{-- Delete button --}}
                            <form action="{{ route('assets.destroy', $asset->id) }}" 
                                  method="POST" 
                                  style="display:inline-block;" 
                                  onsubmit="return confirm('Are you sure you want to delete this asset?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1">Delete</button>
                            </form>

                            {{-- Sell button --}}
                            <a href="{{ route('sales.create', ['asset_id' => $asset->id]) }}" 
                               class="btn btn-success btn-sm" 
                               onclick="return confirm('Do you want to sell this asset?')">
                               Sell
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('assets.create') }}" class="btn btn-success mt-3"><b>Add New Asset</b></a>
</div>
@endsection
