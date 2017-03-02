<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fattura extends Model
{
    protected $table = 'fatture';
    
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
    protected $fillable = [ 'numero',
                            'dettaglio_prestazione',
                            'importo_netto',
                            'importo_esente',
                            'appartenenza'];
                            
    protected $dates = [ 'created_at'];

}
