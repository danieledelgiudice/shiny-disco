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
        'luogo_nascita',
        'codice_fiscale',
        'via',
        'citta',
        'provincia',
        'cap',
        'cellulare',
        'telefono',
        'email',
        'fax',
        'partita_iva',
        'tipo_documento',
        'numero_docuemtno',
        'stato_civile',
        'reddito',
        'numero_card',
        'note',
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
