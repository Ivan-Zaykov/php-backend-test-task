<?php

namespace Tests\Controller;

use App\Models\AircraftAirport;
use Illuminate\Http\Response;
use Tests\TestCase;

class AircraftAirportControllerTest extends TestCase
{
    public function testAircraftAirportControllerShow()
    {
        $flightData = AircraftAirport::get()->random();

        $this->json(
            'get',
            "api/aircraft_airports?$flightData->tail&$flightData->date_from&$flightData->date_to"
        )
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    [
                        "airport_id" => $flightData->airport->id,
                        "code_iata" => $flightData->airport->code_iata,
                        "code_icao" => $flightData->airport->code_icao,
                        "cargo_offload" => $flightData->cargo_offload,
                        "cargo_load" => $flightData->cargo_load,
                        "landing" => $flightData->landing,
                        "takeoff" => $flightData->takeoff
                    ]
                ]
            );
    }
}
