<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AircraftAirport extends Model
{
    use HasFactory;

    protected $table = 'flights';

    public function airport()
    {
        return $this->belongsTo(Airport::class, 'airport_id2', 'id');
    }
}
