<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    public function airport()
    {
        return $this->belongsTo(Airport::class, 'airport_id2', 'id');
    }

    public function aircraft()
    {
        return $this->belongsTo(Aircraft::class);
    }
}
