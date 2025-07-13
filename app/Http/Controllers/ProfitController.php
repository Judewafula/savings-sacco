<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfitController extends Controller
{
    public function index()
{
    $rawProfits = DB::table('sales')
        ->join('assets', 'sales.asset_id', '=', 'assets.id')
        ->selectRaw('
            MONTH(sales.created_at) as month,
            SUM((sales.price - assets.cost_price) * sales.quantity) as total_profit
        ')
        ->whereYear('sales.created_at', now()->year)
        ->groupByRaw('MONTH(sales.created_at)')
        ->orderBy('month')
        ->get();

    $monthlyData = collect(range(1, 12))->map(function ($monthNum) use ($rawProfits) {
        $match = $rawProfits->firstWhere('month', $monthNum);
        return [
            'month' => $monthNum,
            'name' => date('F', mktime(0, 0, 0, $monthNum, 1)),
            'total_profit' => $match ? (float) $match->total_profit : 0,
        ];
    });

    $months = $monthlyData->pluck('name')->toArray();
    $profitData = $monthlyData->pluck('total_profit')->toArray();
    $totalProfit = array_sum($profitData);

    return view('profit', compact('months', 'profitData', 'totalProfit'));
}
}