<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conversations = \App\Conversation::all()->each(function ($conversation, $key) {
            factory(\App\Message::class)->create([
                'conversation_id' => $conversation->id,
                'sender_id' =>  $conversation->sender_id,
                'receiver_id' =>  $conversation->receiver_id,
            ]);
        });
    }
}
