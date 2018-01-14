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
        App\Models\User::truncate();

        factory(App\Models\User::class, 150)->create()->each(function ($user) {
            $user->skills()->saveMany(App\Models\Skill::all()->random(rand(5, 25)));
        });

        $user = App\Models\User::create([
            'first_name' => 'Bram',
            'last_name' => 'van Osta',
            'email' => 'bramvanosta@gmail.com',
            'password' => 'password',
            'avatar' => 'http://pngimg.com/uploads/man/man_PNG6534.png',
            'expertise' => 'React developer'
        ]);

        $user->skills()->saveMany(App\Models\Skill::all()->random(rand(5, 25)));
    }
}
