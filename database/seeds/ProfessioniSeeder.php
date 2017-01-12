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
        DB::table('professioni')->insert(['nome' => 'Show-girl']);
        DB::table('professioni')->insert(['nome' => 'Culturista']);
        DB::table('professioni')->insert(['nome' => 'Responsabile delle comunicazioni']);
        DB::table('professioni')->insert(['nome' => 'Politico']);
    }
}
