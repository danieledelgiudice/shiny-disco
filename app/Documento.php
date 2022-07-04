<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Documento extends Model
{
    protected $table = 'documenti';
    
    protected static function boot() {
        parent::boot();

        static::deleting(function($documento) {
             Storage::disk('local_documents')->delete($documento->nome_file);
        });
    }
    
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
        'descrizione',
	    'nome_file',
	    'nome_file_originale',
	    'categoria',
	    'mime'
    ];
    
    const OLD = 1;
    const POSTA_ENTRATA_USCITA = 2;
    const CERTIFICAZIONI_MEDICHE = 3;
    const ATTI_VARI = 4;
    const PERIZIA_MEDICO_LEGALE = 5;
}
