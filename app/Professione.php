<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professione extends Model
{
    protected $table = 'professioni';
    
    /**
     *  Ritorna la pratica relativa al documento
     */
    public function clienti()
    {
        return $this->hasMany('\App\Cliente', 'professione_id', 'id');
    }
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'nome' ];

}
