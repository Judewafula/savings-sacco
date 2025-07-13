<?php
// app/Models/Asset.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'date_recorded',
        'asset_description',
        'color_of_asset',
        'price',
        'quantity'
    ];


public function sales()
{
    return $this->hasMany(Sale::class);
}

}
