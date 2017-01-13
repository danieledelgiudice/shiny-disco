<?php

use Illuminate\Database\Seeder;

class ProfessioniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professioni')->insert(['nome' => 'Calzolaio']);
        DB::table('professioni')->insert(['nome' => 'Giardiniere']);
        DB::table('professioni')->insert(['nome' => 'Insegnante']);
        DB::table('professioni')->insert(['nome' => 'Autista']);
        DB::table('professioni')->insert(['nome' => 'Dentista']);
        DB::table('professioni')->insert(['nome' => 'Contabile']);
        DB::table('professioni')->insert(['nome' => 'Impiegato']);
    }
}
