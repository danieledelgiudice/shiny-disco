<?php

use Illuminate\Database\Seeder;

class ClientiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cliente::class, 200)->create();
    }
}
