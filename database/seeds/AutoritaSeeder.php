<?php

use Illuminate\Database\Seeder;

class AutoritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('autorita')->insert(['nome' => 'Sconosciuta']);
        DB::table('autorita')->insert(['nome' => 'Polizia']);
        DB::table('autorita')->insert(['nome' => 'Polizia stradale']);
        DB::table('autorita')->insert(['nome' => 'Carabinieri']);
        DB::table('autorita')->insert(['nome' => 'Vigili urbani']);
    }
}