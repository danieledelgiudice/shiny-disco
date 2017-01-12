<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

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
	    'mime'
    ];

}
