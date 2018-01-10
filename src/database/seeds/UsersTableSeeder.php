<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 25)->create()->each(function ($user) {
            $user->skills()->saveMany(App\Models\Skill::all()->random(rand(5, 10)));
        });
    }
}
