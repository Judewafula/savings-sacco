@extends('layouts.app')

<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

               <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  Your logged in
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection

<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html><br><br><br>
<head>
    <title>Home Page</title>
</head>
<body>
<b><p>Your at Home Page<p><b>
    @foreach($assets as $asset)
        @if(is_object($asset) && isset($asset->name))
            <div>
                <h3>{{ $asset->name }}</h3>
                <p>Type: {{ $asset->type }}</p>
                <img src="{{ $asset->url }}" alt="{{ $asset->name }}">
            </div>
        @endif
    @endforeach
    <a href="{{ route('assets.dashboard') }}"></a><br>
 
    <a href="{{ route('assets.index') }}" style="padding: 10px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
    Go to Assets Page
</a><br><br>
    <a href="{{ route('sales.index') }}" style="padding: 10px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
    Go to  Sales Page
</a><br>
<style>
a:hover {
    background-color: #45a049; /* Darker green on hover */
}
</style>
</body>
</html><br>
<!--<nav>
    !-- Add the logout form here -->
   <!-- <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</nav>-->


<a href="{{ route('assets.dashboard') }}">Go to Dashboard</a>
