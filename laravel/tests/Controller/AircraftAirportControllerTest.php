<?php

namespace Tests\Controller;

use App\Models\Flight;
use Illuminate\Http\Response;
use Tests\TestCase;

class AircraftAirportControllerTest extends TestCase
{
    public function testAircraftAirportControllerShow()
    {
        $flightData = Flight::get()->random();

        $this->json(
            'get',
            "api/aircraft_airports?$flightData->tail&$flightData->date_from&$flightData->date_to"
        )
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    [
                        "airport_id" => $flightData->airport_id,
                        "code_iata" => $flightData->code_iata,
                        "code_icao" => $flightData->code_icao,
                        "cargo_offload" => $flightData->cargo_offload,
                        "cargo_load" => $flightData->cargo_load,
                        "landing" => $flightData->landing,
                        "takeoff" => $flightData->takeoff
                    ]
                ]
            );
    }
}
