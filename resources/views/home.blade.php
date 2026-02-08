@extends('layouts.app')

@section('content')

<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

<div class="container mt-4">

    <h2 class="mb-4"><b>You are at the Home Page</b></h2>

    {{-- Assets Section --}}
    @if(isset($assets) && count($assets) > 0)
        @foreach($assets as $asset)
            <div class="card mb-3 p-3">
                <h4>{{ $asset->name }}</h4>
                <p><b>Type:</b> {{ $asset->type }}</p>

                @if(isset($asset->url))
                    <img src="{{ $asset->url }}" alt="{{ $asset->name }}" 
                         style="max-width: 200px; border-radius: 8px;">
                @endif
            </div>
        @endforeach
    @else
        <p>No assets available.</p>
    @endif

    {{-- Links --}}
    <div class="mt-4">
        <a href="{{ route('assets.index') }}" 
           class="btn btn-success mb-3">
            Go to Assets Page
        </a>

        <br>

        <a href="{{ route('sales.index') }}" 
           class="btn btn-success">
            Go to Sales Page
        </a>
    </div>

</div>

@endsection
