<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'pagamenti';

    protected $fillable = [
        'data',
        'importo',
        'cose',
        'persone',
        'spese_mediche'
    ];

    protected $dates = [
        'data',
    ];

    /**
     *  Ritorna la pratica relativa al pagamento
     */
    public function pratica()
    {
        return $this->belongsTo('\App\Pratica', 'pratica_id');
    }

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
}
