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
    
    public $enumSesso = [
        0 => 'Non definito',
        1 => 'Uomo',
        2 => 'Donna'
    ];
    
    public $enumStatoCivile = [
        0 => 'Nubile/Celibe',
        1 => 'Sposato/a',
        2 => 'Divorziato/a',
        3 => 'Separato/a',
        4 => 'Vedovo/a',
    ];
    
    
    /**
     *  Ritorna le pratiche relative al cliente
     *
     */
    public function pratiche()
    {
        return $this->hasMany('\App\Pratica', 'cliente_id', 'id');
    }
}
