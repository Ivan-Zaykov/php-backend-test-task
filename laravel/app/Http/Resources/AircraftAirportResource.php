<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AircraftAirportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "airport_id" => $this->airport_id,
            "code_iata" => $this->code_iata,
            "code_icao" => $this->code_icao,
            "cargo_offload" => $this->cargo_offload,
            "cargo_load" => $this->cargo_load,
            "landing" => $this->landing,
            "takeoff" => $this->takeoff
        ];
    }
}
