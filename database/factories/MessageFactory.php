<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    do {
        $user_id = rand(1, 10);
        $receiver_id = rand(1, 10);
    } while ($user_id == $receiver_id);

    return [
        //
        'user_id' => $user_id,
        'receiver_id' => $receiver_id,
        'message' => $faker->sentence
    ];
});
