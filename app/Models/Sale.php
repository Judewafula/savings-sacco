<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Sale extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'asset_id',
        'quantity',
        'user_id',
        'price',         // unit selling price at time of sale
        'total_price',   // total sale price (price * quantity)
        'sale_date'
    ];

    // Relation to Asset
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    // Relation to User (who made the sale)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
