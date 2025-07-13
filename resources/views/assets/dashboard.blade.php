@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Assets Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav li {
            display: inline;
            margin-right: 6px;
        }
        nav a {
            text-decoration: none;
            color: #000;
        }
        section {
            margin: 10px 0;
        }
        .metric {
            display: inline-block;
            margin-right: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 2px;
            font-weight: bold;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-info {
            background-color: #17a2b8;
            color: white;
        }
    </style>
</head>
<body>
    <h3>Welcome to the Assets Stock reporting summary</h3>

      <section id="overview">
        
        <div class="metric">
            <h3>Total Asset Types</h3>
            <p>{{ $assets->count() }}</p>
        </div>
        <div class="metric">
            <h3>Total Remaining Stock</h3>
            <p>{{ $assets->sum('total_quantity') - $assets->sum('sold_quantity') }}</p>
        </div>
        <div class="metric">
            <h3>Total Sold Quantity</h3>
            <p>{{ $assets->sum('sold_quantity') }}</p>
        </div>
    </section>

    <section id="assets">
        <h2>Asset Inventory</h2>
        @if($assets->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Asset Name</th>
                    <th>Description</th>
                    <th>Remaining Quantity</th>
                    <th>Sold Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assets as $index => $asset)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>{{ $asset->asset_description ?? 'N/A' }}</td>
                        <td>{{ $asset->total_quantity - $asset->sold_quantity }}</td>
                        <td>{{ $asset->sold_quantity }}</td>
                        <td>{{ number_format($asset->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No assets available.</p>
        @endif
    </section>

</body>
</html>

@endsection
