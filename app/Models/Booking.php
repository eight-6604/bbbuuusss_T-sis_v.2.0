<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;  // For generating booking reference

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    // Defining the attributes that are mass assignable
    protected $fillable = [
        'user_id', 'bus_id', 'route_id', 'seat_number', 'seat_type', 'status', 
        'departure_time', 'arrival_time', 'amount_paid', 'payment_status', 'booking_reference',
    ];

    // Custom attribute casting, for example, casting timestamps if needed
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // Defining relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    // public function route()
    // {
    //     return $this->belongsTo(Route::class);
    // }

    // public function payment()
    // {
    //     return $this->hasOne(BookingPayment::class);
    // }

    // public function seats()
    // {
    //     return $this->hasMany(BookingSeat::class);
    // }

    // public function logs()
    // {
    //     return $this->hasMany(BookingLog::class);
    // }

    // public function notifications()
    // {
    //     return $this->hasMany(BookingNotification::class);
    // }

    // Accessor to format the amount paid (if necessary)
    public function getAmountPaidAttribute($value)
    {
        return number_format($value, 2);
    }

    // Mutator to ensure booking_reference is unique and automatically generated
    public static function boot()
    {
        parent::boot();

        // Automatically generate booking_reference on creation
        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = strtoupper(Str::random(10));  // Example: ABC1234567
            }
        });
    }

    // Custom query scope for filtering pending bookings (if you want to fetch them easily)
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Add any other custom logic (if needed)
}
