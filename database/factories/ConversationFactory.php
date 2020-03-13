<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Conversation;
use Faker\Generator as Faker;

$factory->define(Conversation::class, function (Faker $faker) {

    do {
        $sender_id = rand(1, 10);
        $receiver_id = rand(1, 10);
    } while ($sender_id == $receiver_id);

    return [
        'sender_id' => $sender_id,
        'receiver_id' => $receiver_id,
    ];
});
