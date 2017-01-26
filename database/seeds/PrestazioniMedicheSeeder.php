<?php

use Illuminate\Database\Seeder;

class PrestazioniMedicheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PrestazioneMedica::class, 2000)->create();
    }
}
