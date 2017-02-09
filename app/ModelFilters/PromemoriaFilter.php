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
        // ['Oggi', 'Ultima settimana', 'Ultimo mese', 'Ultimo anno', 'Qualsiasi data']
        $today = \Carbon\Carbon::today();
        
        if ($value == 4) // Qualsiasi data
            return $this;
        
        if ($value == 0) // Oggi
            return $this->whereDate('quando', '=', \Carbon\Carbon::today());
            
        if ($value == 1) { // Ultima settimana
            $d = \Carbon\Carbon::today();
            $d->subWeek();
            return $this->whereDate('quando', '>=', $d)->whereDate('quando', '<=', \Carbon\Carbon::today());
        }
        
        if ($value == 2) { // Ultimo mese
            $d = \Carbon\Carbon::today();
            $d->subMonth();
            return $this->whereDate('quando', '>=', $d)->whereDate('quando', '<=', \Carbon\Carbon::today());
        }
        
        if ($value == 3) { // Ultimo anno
            $d = \Carbon\Carbon::today();
            $d->subYear();
            return $this->whereDate('quando', '>=', $d)->whereDate('quando', '<=', \Carbon\Carbon::today());
        }
    }
}