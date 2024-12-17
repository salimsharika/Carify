<?php

namespace App\Models;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public static function boot()
{
    parent::boot();

    // Trigger after a comment is created
    static::created(function ($comment) {
        $carOwner = $comment->car->owner;

        // Create a notification for the car owner
        Notification::create([
            'user_id' => $carOwner->id,
            'comment_id' => $comment->id,
        ]);
    });
}
}
