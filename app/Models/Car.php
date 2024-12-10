<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_name',
        'distance_travelled',
        'date_of_purchase',
        'is_for_sale',
        'user_id'
    ];

    protected $casts = [
        'is_for_sale' => 'boolean',
        'date_of_purchase' => 'date',
        'distance_travelled' => 'float'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the users who have added this car to their wishlist.
     */
    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
}