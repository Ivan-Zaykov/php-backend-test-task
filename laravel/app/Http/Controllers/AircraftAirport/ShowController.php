<?php

namespace App\Http\Controllers\AircraftAirport;

use App\Http\Controllers\Controller;
use App\Http\Resources\AircraftAirportResource;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    public function __invoke(FormRequest $request)
    {
        $tail = $request->tail;
        $dateFrom = Carbon::parse($request->date_from)->toDateTimeString();
        $dateTo = Carbon::parse($request->date_to)->toDateTimeString();

        /*
         * Используется оконная функция LEAD,
         * т.к. данные о вылете из аэропорта находятся в след. строке таблицы flights.
         * В WHERE используется принцип пересечения отрезков, лежащих на одной прямой:
         * где landing и takeoff - первая и вторая точка одного отрезка, а $dateFrom и $dateTo - второго.
         * Если хотя бы landing или takeoff находится между $dateFrom и $dateTo,
         * то пребывание в аэропорту попадает пересекается с временным отрезком от- до- .
         * */
        $aircraftFlights = DB::select(
            "
            SELECT *
            FROM (SELECT airport_id2 as airport_id,
                         code_iata,
                         code_icao,
                         cargo_offload,
                         cargo_load,
                         landing,
                         LEAD(takeoff) OVER (PARTITION BY aircraft_id ORDER BY takeoff) as takeoff
                FROM flights
                       JOIN airports ON airport_id2 = airports.id
                       JOIN aircrafts ON flights.aircraft_id = aircrafts.id
                WHERE tail = '$tail'
                ORDER BY flights.id) airport_data
            WHERE (landing BETWEEN '$dateFrom' AND '$dateTo' OR takeoff BETWEEN '$dateFrom' AND '$dateTo')
                  OR
                  (landing <= '$dateFrom' AND takeoff >= '$dateTo')
                  OR
                  (landing <= '$dateTo' AND takeoff is null);"
        );

        return AircraftAirportResource::collection($aircraftFlights);
    }
}
