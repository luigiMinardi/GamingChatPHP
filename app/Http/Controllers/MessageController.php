<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();
        return response()->json($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message;
        $message->user_id = auth()->user()->id;
        $message->party_id = $request->party_id;
        $message->message = $request->message;
        $message->save();
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        return response()->json($message);
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
        $userId = auth()->user()->id;
        $message = Message::where('user_id', $userId)->findOrFail($id);
        $message->message = $request->message;
        $message->save();
        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = auth()->user()->id;
        $message = Message::where('user_id', $userId)->findOrFail($id);
        $message->delete();
        return response()->json($message);
    }

    /**
     * Display the resources that are in the specified party_id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByParty($id)
    {
        $messages = DB::table('messages')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->select('messages.id', 'messages.message', 'messages.updated_at', 'users.name as user_name')
            ->where('messages.party_id', $id)
            ->get();

        return response()->json($messages);
    }
}
