<!-- resources/views/assets/select.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Select Asset</h1>
    
    @if (isset($asset))
        <div>
            <p><strong>Name:</strong> {{ $asset->name }}</p>
            <p><strong>Value:</strong> {{ $asset->value }}</p>
        </div>

        <form action="{{ route('assets.confirmSelection', ['id' => $asset->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Confirm Selection</button>
        </form>
    @else
        <p>Asset not found.</p>
    @endif
@endsection
