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
        DB::table('filiali')->insert([  'nome' => 'Filiale principale',
                                        'indirizzo' => 'Via del Mare 11, Livorno',
                                        'telefono' => '0586/116341'
                                    ]);
        DB::table('filiali')->insert([  'nome' => 'Filiale 2',
                                        'indirizzo' => 'Viale dell\'indipendenza 8, Pisa',
                                        'telefono' => '050/181341'
                                    ]);
        DB::table('filiali')->insert([  'nome' => 'Filiale 3',
                                        'indirizzo' => 'Via Nuoro 986, Livorno',
                                        'telefono' => '0586/816341'
                                    ]);
        DB::table('filiali')->insert([  'nome' => 'Filiale 4',
                                        'indirizzo' => 'Via della Bassata 23, Livorno',
                                        'telefono' => '0586/866341'
                                    ]);
    }
}
