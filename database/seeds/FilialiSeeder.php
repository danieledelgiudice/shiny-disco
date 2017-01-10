<?php

use Illuminate\Database\Seeder;

class FilialiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filiali')->insert(['nome' => 'Filiale principale']);
        DB::table('filiali')->insert(['nome' => 'Filiale #1']);
        DB::table('filiali')->insert(['nome' => 'Filiale #2']);
        DB::table('filiali')->insert(['nome' => 'Filiale #3']);
    }
}
