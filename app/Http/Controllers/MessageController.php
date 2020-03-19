<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
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
            $query->where('messages.user_id', '=', $user->id);
        })->orWhereHas('user', function (Builder $query) use ($user) {
            $query->where('messages.receiver_id', '=', $user->id);
        })->groupBy('receiver_id')->with('user')->with('receiver')->get();

//        dd($user);
//        $users = User::where('id','!=',$user->id)->whereHas('messages', function (Builder $query) use ($user) {
//            $query->Where('user_id', '=', $user->id);
//        })->get();

//        dd($users);

        return $messages;
    }

    public function users()
    {
        $users = User::all()->except(Auth::id());
        return $users;
    }

    public function sendMessage()
    {
        $payload = request()->all();
        request()->validate([
            'message' => 'required'
        ]);
        $message = Message::create($payload);
        broadcast(new NewMessage($message))->toOthers();
        return $message;
    }


}
