<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filiale extends Model
{
    protected $table = 'filiali';
    
    public function clienti()
    {
        return $this->hasMany('\App\Clienti', 'filiale_id', 'id');
    }
    
    public function utenti()
    {
        return $this->hasOne('\App\Users', 'filiale_id', 'id');
    }
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome'];

}
