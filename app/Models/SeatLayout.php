<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatLayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_type_id',
        'layout_name',
        'rows',
        'columns',
        'seats'
    ];

    protected $casts = [ 
        'seats' => 'array',
    ];

    public function busType(){
        return $this->belongsTo(BusType::class,'bus_type_id');
    }

    public function buses()
    {
        return $this->hasMany(Bus::class,'seat_layout_id');
    }

}
