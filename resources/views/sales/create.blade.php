@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Create Sale</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error message --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-bottom: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        @if (isset($asset))
            <input type="hidden" name="asset_id" value="{{ $asset->id }}">
            <p>
                <strong>Asset:</strong> {{ $asset->name }} 
                ({{ $asset->total_quantity - $asset->sold_quantity }} available)
            </p>
        @elseif(isset($assets))
            <label for="asset_id">Choose Asset:</label>
            <select name="asset_id" id="asset_id" required>
                @foreach ($assets as $assetOption)
                    <option value="{{ $assetOption->id }}">
                        {{ $assetOption->name }} 
                        ({{ $assetOption->total_quantity - $assetOption->sold_quantity }})
                    </option>
                @endforeach
            </select>
        @endif

        <div style="margin-top: 10px;">
            <label for="quantity">Quantity to Sell:</label>
            <input type="number" name="quantity" id="quantity" min="1"
                @if(isset($asset)) 
                    max="{{ $asset->total_quantity - $asset->sold_quantity }}" 
                @endif
                required>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 15px;">Place Sale</button>
    </form>

</div>
@endsection
