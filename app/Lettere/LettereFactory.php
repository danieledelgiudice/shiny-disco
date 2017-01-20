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
    }
    
    public function dataSource($source)
    {
        foreach($source as $model => $values) 
            $this->data[$model] = $values->toArray();
    }
    
    public function generate($id)
    {
        $genClass = $this->generators[$id];
        $generator = new $genClass;
        $letter = $generator->generate($this->data);
        return $letter;
    }
}