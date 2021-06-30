<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Flight::with('tickets')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Flight::withCount('tickets')->with('tickets')->findOrFail($id);
    }

    /**
     * Store Flight.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flightFields = $request->validate([
            'flight_name' => 'required',
            'departure' => 'required',
            'departure_time' => 'required',
            'destination' => 'required',
            'arrival_time' => 'required',
            'airline' => 'required',
        ]);

        $flight = Flight::create([
            'flight_name' => $flightFields['flight_name'],
            'departure' => $flightFields['departure'],
            'departure_time' => $flightFields['departure_time'],
            'destination' => $flightFields['destination'],
            'arrival_time' => $flightFields['arrival_time'],
            'airline' => $flightFields['airline'],
        ]);

        return response($flight, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $flight = Flight::where('id', $id)->first();
        $flight->update($request->all());

        return response($flight, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Flight::findOrFail($id)->delete();

        return response(['message' => 'Flight has been deleted'], 200);
    }

}
