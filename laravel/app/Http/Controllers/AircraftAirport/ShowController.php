<?php

namespace App\Http\Controllers\AircraftAirport;

use App\Http\Controllers\Controller;
use App\Http\Resources\AircraftAirportResource;
use App\Models\AircraftAirport;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke()
    {
        $aircraftAirport = AircraftAirport::get()->random();
        return new AircraftAirportResource($aircraftAirport);
    }
}
