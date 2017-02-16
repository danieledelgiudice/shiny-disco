<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;


class PrestazioneMedica extends Model
{
    use FormAccessible;
    
    protected $table = 'prestazioniMediche';
    
    /**
     *  Ritorna la pratica relativa al documento
     */
    public function pratica()
    {
        return $this->belongsTo('\App\Pratica', 'pratica_id');
    }
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_medico',
        'data',
        'giorni',
        'costo',
        'pagato',
        'percentuale',
    ];

    protected $dates = [
        'data',
    ];
    
    // Mutator data
    public function setDataAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data'] = null;
        else
            $this->attributes['data'] = $value;
    }
    
   
    // Form Accessor data
    public function formDataAttribute($value)
    {
        return format_date($value);
    }
    
    
    public function inConvenzione()
    {
        return $this->percentuale != 0;
    }
    
    public function getInConvenzioneAttribute()
    {
        return $this->inConvenzione();
    }
    
    public function getAPagareAttribute()
    {
        if ($this->inConvenzione())
            return $this->costo * (100 - $this->percentuale)/100;
        else
            return 0;
    }
    
    public function getQuantitaPercentualeAttribute()
    {
        if ($this->inConvenzione())
            return $this->costo * ($this->percentuale)/100;
        else
            return 0;
    }

    
    public function scopeInConvenzione($query)
    {
        return $query->where('percentuale', '!=', 0);
    }
    
    public function scopeNonConvenzione($query)
    {
        return $query->where('percentuale', 0);
    }
}
