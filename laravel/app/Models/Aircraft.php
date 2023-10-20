<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aircraft extends Model
{
    use HasFactory;

    protected $table = 'aircrafts';

    public function flights(): HasMany
    {
        return $this->hasMany(AircraftAirport::class, 'aircraft_id', 'id');
    }
}
