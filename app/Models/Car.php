<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_name',
        'distance_travelled',
        'date_of_purchase',
        'is_for_sale', // Include this field
    ];
    
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}