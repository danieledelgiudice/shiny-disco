<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;


class Assegno extends Model
{
    use FormAccessible;
    
    protected $table = 'assegni';
    
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
        'data',
        'importo',
        'banca',
        'data_azione',
        'tipologia',
        'data_scadenza',
    ];

    protected $dates = [
        'data',
        'data_azione',
        'data_scadenza'
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
    
    // Mutator data_azione
    public function setDataAzioneAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_azione'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_azione'] = null;
        else
            $this->attributes['data_azione'] = $value;
    }
    
    // Mutator data_scadenza
    public function setDataScadenzaAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_scadenza'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_scadenza'] = null;
        else
            $this->attributes['data_scadenza'] = $value;
    }
    
    // Form Accessor data
    public function formDataAttribute($value)
    {
        return format_date($value);
    }
    
    // Form Accessor data_azione
    public function formDataAzioneAttribute($value)
    {
        return format_date($value);
    }
    
    // Form Accessor data_scadenza
    public function formDataScadenzaAttribute($value)
    {
        return format_date($value);
    }
}
