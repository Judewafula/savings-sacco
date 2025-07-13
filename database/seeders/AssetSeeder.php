<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AssetSeeder extends Seeder
{
    public function run()
    {
        DB::table('assets')->insert([
            'name' => 'Smart Charger',
            'value' => 25000,
            'date_recorded' => '2024-05-05', // Ensure this is a valid date format
            'asset_description' => 'First hand',
            'color_of_asset' => 'Red',
            'selling_price' => 27000,
            'total_quantity' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
