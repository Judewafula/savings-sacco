@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Asset</h1>

    <!-- Show success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('assets.update', $asset->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Asset Name</label>
            <input type="text" name="name" value="{{ old('name', $asset->name) }}" class="form-control"><br>

            <label for="value">Asset Value</label>
            <input type="number" step="0.01" name="value" value="{{ old('value', $asset->value) }}" class="form-control"><br>

            <label for="date_recorded">Date Recorded</label>
            <input type="date" name="date_recorded" value="{{ old('date_recorded', $asset->date_recorded) }}" class="form-control"><br>

            <label for="asset_description">Asset Description</label>
            <input type="text" name="asset_description" value="{{ old('asset_description', $asset->asset_description) }}" class="form-control"><br>

            <label for="color_of_asset">Color of Asset</label>
            <input type="text" name="color_of_asset" value="{{ old('color_of_asset', $asset->color_of_asset) }}" class="form-control"><br>

            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $asset->price) }}" class="form-control"><br>

            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" value="{{ old('quantity', $asset->quantity) }}" class="form-control"><br>
        </div>

        <button type="submit" class="btn btn-success">Update Asset</button>
    </form>
</div>
@endsection
