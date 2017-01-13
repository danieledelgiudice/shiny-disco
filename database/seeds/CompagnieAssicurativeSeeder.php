<?php

use Illuminate\Database\Seeder;

class CompagnieAssicurativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CompagniaAssicurativa::class, 30)->create();
    }
}
