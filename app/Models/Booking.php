<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'hotel_id',
        'check_in',
        'check_out',
        'guests',
        'status',
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Hotel model
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
