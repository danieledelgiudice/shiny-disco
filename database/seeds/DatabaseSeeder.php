<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FilialiSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ProfessioniSeeder::class);
        $this->call(AutoritaSeeder::class);
        $this->call(ClientiSeeder::class);
        $this->call(PraticheSeeder::class);
        $this->call(AssegniSeeder::class);
        $this->call(PrestazioniMedicheSeeder::class);
    }
}
