@extends('layouts.app')

@section('content')
<div class="container">
    <br><br><br>
    <h1>Add New Asset</h1>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Asset Form --}}
    <form method="POST" action="{{ route('assets.store') }}" id="assetForm">
        @csrf

        <div class="form-group">
            <label for="name">Asset Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="value">Value:</label>
            <input type="number" class="form-control" id="value" name="value" step="0.01" value="{{ old('value') }}" required>
        </div>

        <div class="form-group">
            <label for="date_recorded">Date Recorded:</label>
            <input type="date" class="form-control" id="date_recorded" name="date_recorded" required>
        </div>

        <div class="form-group">
            <label for="asset_description">Description:</label>
            <select id="asset_description" name="asset_description" class="form-control" required>
                <option value="first hand">First Hand</option>
                <option value="second hand">Second Hand</option>
                <option value="good condition">Good Condition</option>
                <option value="bad condition">Bad Condition</option>
                <option value="original">Original</option>
                <option value="low quality">Low Quality</option>
            </select>
        </div>

        <div class="form-group">
            <label for="color_of_asset">Color:</label>
            <input type="text" class="form-control" id="color_of_asset" name="color_of_asset" value="{{ old('color_of_asset') }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price') }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Initial Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
        </div>

        <button type="submit" id="submitBtn" class="btn btn-success mt-3">Add Asset</button>
        <a href="{{ route('assets.index') }}" class="btn btn-secondary mt-3">Back to Assets</a>
    </form>
</div>

{{-- Prevent double submission --}}
<script>
    document.getElementById('assetForm').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerText = 'Submitting...';
    });
</script>
@endsection
