<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = DB::table('tickets')
            ->join('users', 'tickets.user_id', '=', 'users.id')
            ->leftJoin('comments_tickets', 'tickets.id', '=', 'comments_tickets.ticket_id')
            ->select('tickets.*', 'users.first_name', 'users.last_name', DB::raw('COUNT(comments_tickets.id) as comments_count'))
            ->groupBy(
                'tickets.id'
                , 'users.first_name'
                , 'users.last_name'
            )
            ->get();

        // dd($tickets);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd("TicketsController@create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd("TicketsController@store");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tickets $tickets)
    {
        dd("TicketsController@show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tickets $tickets)
    {
        dd("TicketsController@edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tickets $tickets)
    {
        dd("TicketsController@update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tickets $tickets)
    {
        dd("TicketsController@destroy");
    }
}
