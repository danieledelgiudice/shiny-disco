<?php

namespace App\Lettere;

class LettereFactory
{
    private $data;
    private $generators;
    
    public function __construct()
    {
        $this->generators = [];
        $this->generators[0] = Art142Generator::class;
        $this->generators[1] = GenericaGenerator::class;
        $this->generators[2] = RicevutaClienteGenerator::class;
        $this->generators[3] = InterventoRCAGenerator::class;
        $this->generators[4] = MandatoPrivacyGenerator::class;
        $this->generators[5] = FrontespizioGenerator::class;
        $this->generators[6] = RicevutaMediciGenerator::class;
        $this->generators[7] = ModelloSoldiGenerator::class;
    }
    
    public function dataSource($source)
    {
        foreach($source as $model => $values) {
            if ($values instanceof \Illuminate\Database\Eloquent\Model)
                $this->data[$model] = $values->toArray();
            else
                $this->data[$model] = $values;
        }
    }
    
    public function generate($id)
    {
        $genClass = $this->generators[$id];
        $generator = new $genClass;
        $letter = $generator->generate($this->data);
        return $letter;
    }
    
    public function listGenerators()
    {
        $res = [];
        foreach($this->generators as $key => $value) {
            $res[$key] = ['name' => $value::NAME, 'requires' => $value::REQUIRES];
        }
        return $res;
    }
}