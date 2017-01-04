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
        0 => 'Sconosciuto',
        1 => 'Uomo',
        2 => 'Donna',
        100 => 'Altro',
    ];
    
    public $enumStatoCivile = [
        0 => 'Sconosciuto',
        1 => 'Nubile/Celibe',
        2 => 'Sposato/a',
        3 => 'Divorziato/a',
        4 => 'Unito/a civilmente',
        5 => 'Vedovo/a',
        100 => 'Altro'
    ];
    
    public $enumTipoDocumento = [
        0 => 'Sconosciuto',
        1 => 'Carta d\'identità',
        2 => 'Patente di guida',
        3 => 'Passaporto',
        4 => 'Patente nautica',
        100 => 'Altro',
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
