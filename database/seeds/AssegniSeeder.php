<?php

use Illuminate\Database\Seeder;

class AssegniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Assegno::class, 1000)->create();
    }
}
