<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'description'
    ];

    public function buses(){
        return $this->hasMany(Bus::class, 'bus_type_id');
    }
}
