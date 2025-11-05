<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_number',
        'bus_name',
        'bus_type',
        'total_seats',
        'bus_img',
        'status',
    ];

      
    // A Bus belongs to a Bus Type (e.g. Deluxe, Sleeper, AC)
     
    public function type()
    {
        return $this->belongsTo(BusType::class, 'bus_type_id');
    }
}
