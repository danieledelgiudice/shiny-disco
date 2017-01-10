<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documenti';
    
    /**
     *  Ritorna la pratica relativa al documento
     */
    public function pratica()
    {
        return $this->belongsTo('\App\Documento', 'pratica_id');
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
