<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    //

    public function index()
    {
        // get all users except logged in
        $users = User::all()->except(Auth::id());
        return view('chat', compact('users'));
    }

    public function show($id)
    {
        $user = Auth::id();
        $messages = Conversation::where(function ($query) use ($user, $id) {
            $query->where('sender_id', $user);
            $query->where('receiver_id', $id);
        })->orWhere(function ($query) use ($user, $id) {
            $query->where('receiver_id', $user);
            $query->where('sender_id', $id);
        })->get();

        return $messages;
    }
}
