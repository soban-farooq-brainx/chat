<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    $user_id = rand(1, 10);
    $group_id = rand(1, 50);

    return [
        //
        'group_id' => $group_id,
        'sender_id' => $user_id,
        'message_text' => $faker->sentence
    ];
});
