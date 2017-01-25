<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ClienteFilter extends ModelFilter
{
    public function cognome($value)
    {
        return $this->whereBeginsWith('cognome', $value);
    }
    
    public function nome($value)
    {
        return $this->whereBeginsWith('nome', $value);
    }
    
    public function cittaNascita($value)
    {
        return $this->whereBeginsWith('citta_nascita', $value);
    }
    
    public function dataNascita($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
        return $this->where('data_nascita', $op, $element);
    }
    
    public function sesso($value)
    {
        return $this->where('sesso', $value);
    }
    
    public function codiceFiscale($value)
    {
        return $this->whereBeginsWith('codice_fiscale', $value);
    }
    
    
    ///////////////////////////////////////////////
    
    
    public function via($value)
    {
        return $this->whereLike('via', $value);
    }
    
    public function cittaResidenza($value)
    {
        return $this->whereBeginsWith('citta_residenza', $value);
    }
    
    public function provincia($value)
    {
        return $this->whereBeginsWith('provincia', $value);
    }
    
    public function cap($value)
    {
        return $this->whereBeginsWith('cap', $value);
    }
    
    
    ///////////////////////////////////////////////
    
    
    public function cellulare($value)
    {
        return $this->whereLike('cellulare', $value);
    }
    
    public function telefono($value)
    {
        return $this->whereLike('telefono', $value);
    }
    
    public function email($value)
    {
        return $this->whereBeginsWith('email', $value);
    }
    
    public function fax($value)
    {
        return $this->whereLike('fax', $value);
    }
    
    
    ///////////////////////////////////////////////
    
    
    public function partitaIva($value)
    {
        return $this->whereBeginsWith('partita_iva', $value);
    }
    
    public function statoCivile($value)
    {
        return $this->where('stato_civile', $value);
    }
    
    public function tipoDocumento($value)
    {
        return $this->where('tipo_documento', $value);
    }
    
    public function numeroDocumento($value)
    {
        return $this->whereBeginsWith('numero_documento', $value);
    }
    
    public function professione($value)
    {
        return $this->where('professione_id', $value);
    }
    
    public function dettagliProfessione($value)
    {
        return $this->whereLike('dettagli_professione', $value);
    }
    
    public function reddito($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';

        return $this->where('reddito', $op, $value[1]);
    }
    
    public function numeroCard($value)
    {
        return $this->whereBeginsWith('numero_card', $value);
    }
    
    
    ///////////////////////////////////////////////
    
    
    public function filiale($value)
    {
        return $this->where('filiale_id', $value);
    }
    
    public function importante($value)
    {
        return $this->where('importante', $value);
    }
    
    
}