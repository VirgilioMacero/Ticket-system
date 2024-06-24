<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $ticket = Ticket::find($id);

        $ticket->entity->load('services');

        return view('ticket.show', ['ticket' => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::find($id);


        if ($ticket->status->state == 'OPEN' || $ticket->status->state == 'IN PROGRESS') {

            if ($request->input('send') == 'saveSolution') {

                $ticket = Ticket::find($id);

                $request->validate([

                    'TicketSolution' => 'required'

                ]);

                $ticket->problem->update(['solution' => $request->input('TicketSolution')]);

                $this->updateUser($id,auth()->user()->id);

                return back();
            } elseif ($request->input('send') == 'saveTicket') {

                $request->validate([

                    'TicketSolution' => 'required'

                ]);
                $ticket->problem->update(['solution' => $request->input('TicketSolution')]);

                $ticket->status->update(['state' => 'CLOSED']);

                $this->updateUser($id,auth()->user()->id);

            }
        } else {

            $ticket->status->update(['state' => 'OPEN']);
        }

        return redirect()->route('ticket.index');
    }

    public function updateStateInProgress($id)
    {

        $ticket = Ticket::find($id);


        $ticket->status->state = 'IN PROGRESS';

        $ticket->status->update();

        $this->updateUser($id,auth()->user()->id);


        return back();
    }

    public function updateStateOpen($id)
    {

        $ticket = Ticket::find($id);

        $ticket->status->state = 'OPEN';

        $ticket->status->update();

        $this->updateUser($id,auth()->user()->id);

        return back();
    }

    public function updateUser($id,$userId){

        $ticket = Ticket::find($id);

        $ticket->user_id = $userId;

        $ticket->update();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
