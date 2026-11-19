<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'food_package_id',
        'quantity',
        'total_price',
        'pickup_code',
        'status',
    ];

    // Menghubungkan reservasi dengan akun pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Menghubungkan reservasi dengan paket makanan
    public function foodPackage()
    {
        return $this->belongsTo(FoodPackage::class);
    }
}