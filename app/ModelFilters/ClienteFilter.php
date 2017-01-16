<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ClienteFilter extends ModelFilter
{
    public function nome($value)
    {
        return $this->whereBeginsWith('nome', $value);
    }
    
    public function cognome($value)
    {
        return $this->whereBeginsWith('cognome', $value);
    }
    
    public function cittaResidenza($value)
    {
        return $this->whereBeginsWith('citta_residenza', $value);
    }
    
    public function codiceFiscale($value)
    {
        return $this->whereBeginsWith('codice_fiscale', $value);
    }
    
    // public function professione($value)
    // {
    //     return $this->whereBeginsWith('codice_fiscale', $value);
    // }
    
    public function filiale($value)
    {
        return $this->where('filiale_id', $value);
    }
    
    public function professione($value)
    {
        return $this->where('professione_id', $value);
    }
}