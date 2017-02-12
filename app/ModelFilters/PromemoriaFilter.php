<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PromemoriaFilter extends ModelFilter
{
    public function chi($value)
    {
        return $this->whereBeginsWith('chi', $value);
    }
    
    public function quando($value)
    {
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        return $this->whereDate('quando', '=', $element->toDateString());
    }
}