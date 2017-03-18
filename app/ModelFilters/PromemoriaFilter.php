<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PromemoriaFilter extends ModelFilter
{
    public $relations = [
        'pratica' => [
            'numero_pratica',
        ]
    ];
    
    public function chi($value)
    {
        return $this->whereBeginsWith('chi', $value);
    }
    
    public function quando($value)
    {
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        return $this->whereDate('quando', '=', $element->toDateString());
    }
    
    public function praticaNumeroPratica($value)
    {
        return $this->push('numero_pratica', $value);
    }
}