<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fattura extends Model
{
    protected $table = 'fatture';
    
    /**
     *  Ritorna la pratica relativa al documento
     */
    public function pratica()
    {
        return $this->belongsTo('\App\Pratica', 'pratica_id');
    }
    
    public function getIvaAttribute()
    {
        return $this->importo_netto * 0.22;
    }
    
    public function getLordoCompetenzeAttribute()
    {
        return $this->importo_netto + $this->iva;
    }
    
    public function getLordoIncassatoAttribute()
    {
        return $this->lordo_competenze + $this->importo_esente;
    }
    
    
    public function getNomeFilialeAttribute()
    {
        switch($this->appartenenza)
        {
            case 1: return 'Ely\'s';
            case 2: return 'Elisir';
            default: return '';
        }
    }
    
    // Mutator data_emissione
    public function setDataEmissioneAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_emissione'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_emissione'] = null;
        else
            $this->attributes['data_emissione'] = $value;
    }
    
    // Form Accessor data_emissione
    public function formDataEmissioneAttribute($value)
    {
        return format_date($value);
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'numero',
                            'dettaglio_prestazione',
                            'data_emissione',
                            'importo_netto',
                            'importo_esente',
                            'appartenenza'];
                            
    protected $dates = [ 'created_at', 'data_emissione'];

}
