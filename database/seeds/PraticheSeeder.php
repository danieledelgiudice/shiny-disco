<?php

use Illuminate\Database\Seeder;

class PraticheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pratica::class, 600)->create();
    }
}
