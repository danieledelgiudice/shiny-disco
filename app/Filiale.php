<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filiale extends Model
{
    protected $table = 'filiali';
    
    public function clienti()
    {
        return $this->hasMany('\App\Cliente', 'filiale_id', 'id');
    }
    
    public function utente()
    {
        return $this->hasOne('\App\User', 'filiale_id', 'id');
    }
    
    public function praticheCondivise()
    {
        return $this->belongsToMany('\App\Pratica', 'condivisioni', 'filiale_id', 'pratica_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'indirizzo', 'telefono'];

}
