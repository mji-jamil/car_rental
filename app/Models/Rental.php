<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'car_id',
        'customer_id',
        'rental_start_date',
        'rental_end_date',
        'total_cost',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
