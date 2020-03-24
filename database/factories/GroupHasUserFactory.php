<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\GroupHasUser::class, function (Faker $faker) {
    $user_id = rand(1, 10);
    $group_id = rand(1, 50);
    return [
        //
        'user_id' => $user_id
    ];
});
