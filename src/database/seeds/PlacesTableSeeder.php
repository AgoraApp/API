<?php

use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Place::class, 200)->create()->each(function ($place) {
            $place->zones()->saveMany(factory(App\Models\Zone::class, 5)->make());
        });
    }
}
