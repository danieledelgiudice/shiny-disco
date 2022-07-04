<?php

use Illuminate\Database\Seeder;

class DocumentiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Documento::class, 3000)->create();
    }
}
