@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2>Profit Dashboard</h2>
    <h4>Total Profit: UGX {{ number_format($totalProfit) }}</h4>

    @if(count($profitData) > 0 && array_sum($profitData) !== 0)
        <div class="d-flex justify-content-center my-4">
            <div style="max-width: 400px; width: 100%;">
                <canvas id="profitChart"></canvas>
            </div>
        </div>
    @else
        <div class="alert alert-warning my-4">No profit data available to show chart.</div>
    @endif

    <h5>Monthly Profit Percentages</h5>
    <ul class="list-unstyled">
        @foreach($profitData as $index => $profit)
            @php
                $percent = $totalProfit != 0 ? round(($profit / $totalProfit) * 100, 2) : 0;
            @endphp
            <li>{{ $months[$index] }}: {{ $percent }}%</li>
        @endforeach
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(count($profitData) > 0 && array_sum($profitData) !== 0)
<script>
    const ctx = document.getElementById('profitChart').getContext('2d');

    const rawData = @json($profitData);
    const profitData = rawData.map(val => Math.round((val + Number.EPSILON) * 100) / 100);

    const labels = @json($months);
    const total = {{ $totalProfit }};
    const colors = profitData.map(value => value >= 0 ? '#28a745' : '#dc3545'); // green or red

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Monthly Profit',
                data: profitData,
                backgroundColor: colors,
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed;
                            const label = context.label;
                            const percent = total !== 0
                                ? ((value / total) * 100).toFixed(2)
                                : '0.00';
                            return `${label}: UGX ${value.toLocaleString()} (${percent}%)`;
                        }
                    }
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        padding: 15
                    }
                }
            }
        }
    });
</script>
@endif
@endsection
