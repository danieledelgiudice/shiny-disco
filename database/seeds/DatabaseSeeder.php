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
        $this->call(ClientiSeeder::class);
        $this->call(PraticheSeeder::class);
    }
}
