<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use Collective\Html\Eloquent\FormAccessible;

class Cliente extends Model
{
    use Filterable;
    use FormAccessible;
    
    protected $table = 'clienti';
    protected $dates = ['data_nascita'];

    protected static function boot() {
        parent::boot();

        static::deleting(function($cliente) {
            foreach($cliente->pratiche as $pratica) {
                $pratica->delete();
            }
        });
    }

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
        'dettagli_professione',
    ];
    
    public static $enumSesso = [
        0 => 'Sconosciuto',
        1 => 'Uomo',
        2 => 'Donna',
    ];
    
    public static $enumStatoCivile = [
        0 => 'Sconosciuto',
        1 => 'Celibe/Nubile',
        2 => 'Sposato/a',
        3 => 'Divorziato/a',
        4 => 'Unito/a civilmente',
        5 => 'Vedovo/a',
        6 => 'Separato/a',
        100 => 'Altro'
    ];
    
    public static $enumTipoDocumento = [
        0 => 'Sconosciuto',
        1 => 'Carta d\'identità',
        2 => 'Patente di guida',
        3 => 'Passaporto',
        4 => 'Patente nautica',
        5 => 'Tessera ministero',
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
    
    /**
     *  Ritorna la filiale a cui appartiene il cliente
     *
     */
    public function filiale()
    {
        return $this->belongsTo('\App\Filiale', 'filiale_id');
    }
    
    /**
     *  Ritorna la professione del cliente
     *
     */
    public function professione()
    {
        return $this->belongsTo('\App\Professione', 'professione_id');
    }
    
    
    
    // Mutator data_nascita
    public function setDataNascitaAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_nascita'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_nascita'] = null;
        else
            $this->attributes['data_nascita'] = $value;
    }
    
    // Form Accessor data_nascita
    public function formDataNascitaAttribute($value)
    {
        return format_date($value);
    }
}
