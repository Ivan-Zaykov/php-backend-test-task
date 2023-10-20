<?php

namespace Tests\Controller;

use App\Models\Aircraft;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;

class AircraftAirportControllerTest extends TestCase
{
    public function testAircraftAirportControllerShow()
    {
        $flight = Flight::get()->random();
        $tail = $flight->aircraft()->first()->tail;
        $dateFrom = $flight->landing;
        $dateTo = Carbon::parse($dateFrom)->addMonth()->format(Carbon::DEFAULT_TO_STRING_FORMAT);

        $this->json(
            'get',
            "api/aircraft_airports/$tail/$dateFrom/$dateTo'"
        )
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    [
                        "airport_id",
                        "code_iata",
                        "code_icao",
                        "cargo_offload",
                        "cargo_load",
                        "landing",
                        "takeoff"
                    ]
                ]
            );
    }
}
