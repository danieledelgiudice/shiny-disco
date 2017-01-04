<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    protected $table = 'clienti';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'cognome',
        'sesso',
        'data_nascita',
        'citta_nascita',
        'codice_fiscale',
        'via',
        'citta_residenza',
        'provincia',
        'cap',
        'cellulare',
        'telefono',
        'email',
        'fax',
        'partita_iva',
        'tipo_documento',
        'numero_documento',
        'stato_civile',
        'reddito',
        'numero_card',
        'note',
    ];
    
    private $enumSesso = [
        0 => 'Non definito',
        1 => 'Maschio',
        2 => 'Femmina'
    ];
    
    private $enumStatoCivile = [
        0 => 'Nubile/Celibe',
        1 => 'Sposato/a',
        2 => 'Divorziato/a',
        3 => 'Separato/a',
        4 => 'Vedovo/a',
    ];
    
    public function getSessoAttribute($value)
    {
        return $this->enumSesso[$value];
    }
    
    public function setSessoAttribute($value)
    {
        $index = array_search($value, $this->enumSesso);
        if($index != false)
            return $this->attributes['sesso'] = $index;
    }
    
    public function getStatoCivileAttribute($value)
    {
        return $this->enumStatoCivile[$value];
    }
    
    public function setStatoCivileAttribute($value)
    {
        $index = array_search($value, $this->enumStatoCivile);
        if($index != false)
            return $this->attributes['stato_civile'] = $index;
    }
    
    /**
     *  Ritorna le pratiche relative al cliente
     *
     */
    public function pratiche()
    {
        return $this->hasMany('\App\Pratica', 'cliente_id', 'id');
    }
}
