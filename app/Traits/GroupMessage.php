<?php

namespace App\Traits;

use App\Group;
use App\GroupHasUser;

trait GroupMessage
{
    public function userExistInGroup($user_id, $group_id)
    {
        $userExistsInGroup = GroupHasUser::where('user_id', $user_id)
            ->where('group_id', $group_id)->first();

        if ($userExistsInGroup) {
            return true;
        }

        return false;
    }

    public function groupExists($group_id)
    {
        if (!Group::find(request()->group_id)) {
            return response()->json(['error' => 'Group doesn\'t exist'], 404);
        }
        return response()->json(['success' => 'Group exists'], 200);

    }
}
