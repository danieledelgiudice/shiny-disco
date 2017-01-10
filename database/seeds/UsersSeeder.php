<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(\App\Filiale::all() as $filiale) {
            DB::table('users')->insert([
                'password' => bcrypt('secret'),
                'filiale_id' => $filiale->id,
                'admin' => ($filiale->id == 1),
                ]);
        }
    }
}
