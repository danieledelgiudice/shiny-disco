<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompagniaAssicurativa extends Model
{
    protected $table = 'compagnieAssicurative';
    
    public function filiale()
    {
        return $this->belongsTo('\App\Filiale', 'filiale_id');
    }
    
    public function parti_assicurate()
    {
        return $this->hasMany('\App\Pratiche', 'assicurazione_parte_id', 'id');
    }
    
    public function controparti_assicurate()
    {
        return $this->hasMany('\App\Pratiche', 'assicurazione_controparte_id', 'id');
    }
    

    protected $fillable = [
        'nome',
        'indirizzo',
        'telefono',
        'fax',
        'email',
        'giorni',
    ];
}
