<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Party::all();
        return response()->json($parties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $party = new Party;
        $party->name = $request->name;
        $party->description = $request->description;
        $party->user_id = $request->user_id;
        $party->game_id = $request->game_id;
        $party->save();
        return response()->json($party);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $party = Party::find($id);
        return response()->json($party);
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
        $party = Party::find($id);
        $party->name = $request->name;
        $party->description = $request->description;
        $party->user_id = $request->user_id;
        $party->save();
        return response()->json($party);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Party::find($id);
        $party->delete();
        return response()->json($party);
    }

    /**
     * Get all parties for a game
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByGame($id)
    {
        $parties = Party::where('game_id', $id)->get();
        return response()->json($parties);
    }
}
