<?php

use Illuminate\Database\Seeder;

class GroupHasUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Group::all()->each(function ($item) {
            $item->group_has_groups()->saveMany(factory(App\GroupHasUser::class, 5)->make());
        });
    }
}
