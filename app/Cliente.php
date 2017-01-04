<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    protected $table = 'clienti';
    
    public $displayName = [
        'nome' => 'Nome',
        'cognome' => 'Cognome',
        'sesso' => 'Sesso',
        'data_nascita' => 'Data di nascita',
        'citta_nascita' => 'Città di nascita',
        'codice_fiscale' => 'Codice Fiscale',
        'via' => 'Via',
        'citta_residenza' => 'Città di residenza',
        'provincia' => 'Provincia',
        'cap' => 'CAP',
        'cellulare' => 'Cellulare',
        'telefono' => 'Telefono',
        'email' => 'Email',
        'fax' => 'FAX',
        'partita_iva' => 'P. IVA',
        'tipo_documento' => 'Tipo documento',
        'numero_documento' => 'Numero documento',
        'stato_civile' => 'Stato civile',
        'reddito' => 'Reddito',
        'numero_card' => 'Numero Card',
        'note' => 'Note',
    ];
    
    
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
    
    
    /**
     *  Ritorna le pratiche relative al cliente
     *
     */
    public function pratiche()
    {
        return $this->hasMany('\App\Pratica', 'cliente_id', 'id');
    }
}
