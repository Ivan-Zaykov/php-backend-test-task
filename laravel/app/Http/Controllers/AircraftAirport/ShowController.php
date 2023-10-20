<?php

namespace App\Http\Controllers\AircraftAirport;

use App\Http\Controllers\Controller;
use App\Http\Resources\AircraftAirportResource;
use App\Models\Aircraft;
use App\Models\Flight;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(FormRequest $request)
    {
        $tail = $request->tail;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

        $aircraft = Aircraft::where('tail', $tail)->first();

        $aircraftFlights =
            $aircraft->flights()->whereBetween('landing', [$dateFrom, $dateTo])->get();

        return AircraftAirportResource::collection($aircraftFlights);
    }
}
