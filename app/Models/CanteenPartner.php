<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanteenPartner extends Model
{
    protected $fillable = [
        'canteen_name',
        'location',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foodPackages()
    {
        return $this->hasMany(FoodPackage::class);
    }
}