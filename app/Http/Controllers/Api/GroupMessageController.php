<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\GroupHasUser;
use App\Http\Controllers\Api\Controller;
use App\Message;
use App\User;
use App\Http\Resources\Message as MessageResource;
use App\Http\Resources\Group as GroupResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\GroupMessage;
use Psy\Util\Json;

class GroupMessageController extends Controller
{
    // use trait
    use GroupMessage;

    public function getGroupsOfCurrentUser()
    {
        // get current user
        $currentUser = $this->getAuthUser();
        if ($currentUser) {
            // get groups of current user, if authorized.
            return GroupHasUser::where('user_id', $currentUser->id)->with('group')->get();
        }

        return $this->unauthorizedUserMessage();
    }

    public function getGroupMessages($group_id)
    {
        $currentUser = $this->getAuthUser();
        if ($currentUser) {
            // check if user belongs to this group or not (trait method)
            $userBelongsInGroup = $this->userExistInGroup($currentUser->id, $group_id);
            if ($userBelongsInGroup) {
                // get messages of group, a user clicks on if user is in that group
                $users_groups = Message::where('group_id', $group_id)->with('user')->get();
                return MessageResource::collection($users_groups);
            }
            // user is not in group
            return response()->json(['error' => 'User doesn\'t belong in this group.'], 403);
        }
        return $this->unauthorizedUserMessage();
    }

    public function sendAGroupMessage()
    {
        // get inputs and authorize user.
        $message = request()->only(['group_id', 'sender_id', 'message_text']);
        $currentUser = $this->getAuthUser();

        if ($currentUser) {
            // check if user and group exist (trait method)
            $userBelongsInGroup = $this
                ->userExistInGroup($currentUser->id, $message['group_id']);
            if ($userBelongsInGroup) {
                // if only user is in group send message
                $message = Message::create($message);
                return new MessageResource($message);
            }
            // other wise throw not found.
            return response()->json(['error' => 'User doesn\'t exist.'], 403);
        }
        return $this->unauthorizedUserMessage();
    }

    public function createGroup()
    {
        // get group fields
        $group = request()->only(['name']);
        $currentUser = $this->getAuthUser();
        if ($currentUser) {
            // transaction to add to 2 tables.
            DB::beginTransaction();
            try {
                // add fields in two tables
                $group = Group::create($group);
                GroupHasUser::create(['user_id' => $currentUser->id, 'group_id' => $group->id]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => 'Could not be created.'], 500);
            }
            // return group added.
            return new GroupResource($group);
        }
        // unauthorized to add a group
        return $this->unauthorizedUserMessage();
    }

    public function addUserToGroup()
    {
        // check if group exists or not.
        if ($this->groupExists(request()->group_id)->status() === 404) {
            return $this->groupExists(request()->group_id);
        }
        $current_user = $this->getAuthUser();
        if ($current_user) {
            $groupHasUserRequest = \request()->only(['group_id']);
            // save a new key user_id with current user
            $groupHasUserRequest['user_id'] = $current_user->id;
            // if user exists with group_id, don't create a new one
            $groupHasUserRequest = GroupHasUser::firstOrCreate($groupHasUserRequest);
            if (!$groupHasUserRequest->wasRecentlyCreated) {
                // return error if user already existed
                return response()->json(['error' => 'User already exists in group.'], 409);
            }
            // return newly created user.
            return new GroupResource($groupHasUserRequest);
        }
        // unauthorized to add a group
        return $this->unauthorizedUserMessage();
    }


    public function leaveGroup($group_id)
    {
        $current_user = $this->getAuthUser();
        if ($current_user) {
            // check if user exists in the group_has_users table
            $group = GroupHasUser::where('user_id', $current_user->id)
                ->where('group_id', $group_id)->first();
            if ($group) {
                $group_has_users_deleted = GroupHasUser::where('user_id', $current_user->id)
                    ->where('group_id', $group_id)->delete();
                if ($group_has_users_deleted) {
                    return response()->json(['success' => 'Left Group'], 200);
                } else {
                    return response()
                        ->json(['success' => 'Could not leave group. An error occurred'], 500);
                }
            }
            return response()->json(['error' => 'User/Group not found.'], 404);
        }
        return $this->unauthorizedUserMessage();
    }
}
