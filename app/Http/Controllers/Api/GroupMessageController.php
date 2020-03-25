<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\GroupHasUser;
use App\Http\Controllers\Api\Controller;
use App\Message;
use App\User;
use App\Http\Resources\Message as MessageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMessageController extends Controller
{

    public function getGroupsOfCurrentUser()
    {
        $currentUser = $this->getAuthUser();
        if ($currentUser) {
            return GroupHasUser::where('user_id', $currentUser->id)->with('group')->get();
        }

        return $this->unauthorizedUserMessage();

    }

    public function getGroupMessages($group_id)
    {
        $currentUser = $this->getAuthUser();
        if ($currentUser) {
            $users_groups = Message::where('group_id', $group_id)->with('user')->get();
            return MessageResource::collection($users_groups);
        }
        return $this->unauthorizedUserMessage();

    }

    public function sendAGroupMessage()
    {
        $message = request()->all();
        $currentUser = $this->getAuthUser();
        if ($currentUser) {
            $message = Message::create($message);
            return new MessageResource($message);
        }
        return $this->unauthorizedUserMessage();
    }


}
