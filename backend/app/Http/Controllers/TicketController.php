<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Economy class
     */
    private const TYPE_TICKET_ECONOMY = 'economy';

    /**
     * Standard class
     */
    private const TYPE_TICKET_STANDARD = 'standard';

    /**
     * Business class
     */
    private const TYPE_TICKET_BUSINESS = 'business';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ticket::findOrFail($id);
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

        $ticketFields = $request->validate([
            'flight_id' => 'required',
            'type' => 'required',
            'cost' => 'required',
        ]);

        $flight = Flight::where('id', $ticketFields['flight_id'])->firstOrFail();


        if (!(mb_strtolower($ticketFields['type']) === self::TYPE_TICKET_ECONOMY ||
            mb_strtolower($ticketFields['type']) === self::TYPE_TICKET_STANDARD ||
            mb_strtolower($ticketFields['type']) === self::TYPE_TICKET_BUSINESS)){

            return  response(['message' => 'choose correct ticket type'], 400);
        }

        $ticket = Ticket::create([
            'flight_id' =>$flight->id,
            'type' => mb_strtolower($ticketFields['type']),
            'cost' => $ticketFields['cost'],
        ]);


        return response($ticket, 201);
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
        $ticket = Ticket::where('id', $id)->first();
        $ticket->update($request->all());

        return response($ticket, 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ticket::findOrFail($id)->delete();

        return response(['message' => 'Ticket has been deleted'], 200);
    }
}
