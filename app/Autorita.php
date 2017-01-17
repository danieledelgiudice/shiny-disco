<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autorita extends Model
{
    protected $table = 'autorita';
    
    /**
     *  Ritorna la pratica relativa al documento
     */
    public function pratiche()
    {
        return $this->hasMany('\App\Pratiche', 'autorita_id', 'id');
    }
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'nome' ];

}
