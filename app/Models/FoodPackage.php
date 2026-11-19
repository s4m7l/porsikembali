<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodPackage extends Model
{
    protected $fillable = [
        'name',
        'description',
        'normal_price',
        'offer_price',
        'stock',
        'pickup_deadline',
    ];

    public function canteenPartner()
    {
        return $this->belongsTo(CanteenPartner::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}