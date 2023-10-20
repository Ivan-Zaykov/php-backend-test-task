<?php

namespace App\Http\Controllers\AircraftAirport;

use App\Http\Controllers\Controller;
use App\Http\Resources\AircraftAirportResource;
use App\Models\Flight;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke()
    {
        $aircraftAirport = Flight::get()->random();
        return new AircraftAirportResource($aircraftAirport);
    }
}
