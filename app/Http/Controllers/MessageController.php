<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function foo\func;

class MessageController extends Controller
{
    //

    public function index()
    {
        // get logged in user
        $user = Auth::user();
        return view('chat', compact('user'));
    }

    public function show($id)
    {
        $user = Auth::id();
        $messages = Message::where(function ($query) use ($user, $id) {
            $query->where('user_id', $user);
            $query->where('receiver_id', $id);
        })->orWhere(function ($query) use ($user, $id) {
            $query->where('receiver_id', $user);
            $query->where('user_id', $id);
        })->get();

        return $messages;

    }

    public function conversations()
    {
//         current user
        $user = Auth::user();

        $messages = Message::whereHas('user', function (Builder $query) use ($user) {
            $query->where('user_id', '=', $user->id);
        })->orWhereHas('user', function (Builder $query) use ($user) {
            $query->where('receiver_id', '=', $user->id);
        })->groupBy('receiver_id')->orderBy('id', 'desc')->get();

        return $messages;
    }

//    public function conversations()
//    {
//        $conversations = collect();
//        $users = User::all();
//        foreach ($users as $user) {
//            $message = Message::where(function ($query) use (&$user) {
//                $query->where('user_id', Auth::id());
//                $query->where('receiver_id', $user->id);
//            })->orWhere(function ($query) use (&$user) {
//                $query->where('user_id', $user->id);
//                $query->where('receiver_id', Auth::id());
//            })->orderBy('id', 'DESC')->first();
//            if ($message) {
//                $user->message = $message;
//                $conversations->push($user);
//            }
//        }
//        return $conversations;
//    }

    public function users()
    {
        $users = User::all()->except(Auth::id());
        return $users;
    }

    public function sendMessage()
    {
        $payload = request()->all();
        $validatedPayload = request()->validate([
            'message' => 'required'
        ]);
        return Message::create($payload);
    }


}
