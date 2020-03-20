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

        return $messages;
    }

    public function jointUsers()
    {
        // get logged in user
        $user = Auth::id();
        // left join to get all users all time
        return DB::table('users')->where('users.id', '!=', $user)
            ->leftJoin('messages', function ($join) use ($user) {
                // first evaluate where in below function
                $join->on('users.id', '=', 'messages.user_id')
                    // filter messages sent to current user
                    ->where('messages.receiver_id', '=', $user)
                    // get only those messages which are unread
                    ->where('messages.is_read', '=', 0);
            })->select('users.*', 'messages.user_id', 'messages.receiver_id', 'messages.message'
                , 'messages.is_read')
            // finally grouped by email to get only 10 records from users table
            ->orderBy('messages.created_at', 'DESC')->groupBy('email')->get();
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

    public function users()
    {
        $current_user = Auth::id();
        return User::where('id', '<>', $current_user)
            ->with(['messages' => function ($q) use ($current_user) {
                $q->where('receiver_id', $current_user)
                    ->where('is_read', 0);
            }])->get();
    }

}
