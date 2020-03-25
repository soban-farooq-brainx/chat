<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\GroupHasUser;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use App\Http\Resources\Message as MessageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMessageController extends Controller
{

    public function getGroupsOfCurrentUser()
    {
        // current user, assume 1
        $current_user_id = 1;
        return GroupHasUser::where('user_id', $current_user_id)->with('group')->get();
    }

    public function getGroupMessages($group_id)
    {
        $users_groups = Message::where('group_id', $group_id)->with('user')->get();
        return MessageResource::collection($users_groups);
    }

    public function sendAGroupMessage()
    {
        $message = request()->all();
        $message = Message::create($message);
        return new MessageResource($message);
    }
}
