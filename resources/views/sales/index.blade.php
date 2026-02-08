@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Feedback Messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

     {{-- Sales Table --}}
    <h3>Sales History</h3>
    @if($sales->count())
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Asset</th>
                    <th>Quantity</th>
                    <th>Sold By</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sale->asset->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ $sale->user->name ?? 'N/A' }}</td>
                        <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No sales have been recorded yet.</p>
    @endif

   

</div>
@endsection
