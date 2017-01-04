<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pratica extends Model
{
    protected $table = 'pratiche';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero_pratica',
        'numero_registrazione',
        'stato_pratica',
        'tipo_pratica',
        'data_apertura',
        
        'veicolo_parte',
        'targa_parte',
        'numero_polizza_parte',
        'assicurazione_parte',
        
        'nominativo_controparte',
        'via_controparte',
        'citta_controparte',
        'telefono_controparte',
        'veicolo_controparte',
        'targa_controparte',
        'numero_polizza_controparte',
        'proprietario_mezzo_responsabile',
        'assicurazione_controparte',
        'medico_controparte',
        
        'legale',
        'in_data',
        'controllato',
        'data_ultima_lettera',
        'mezzo_liquidabile',
        'valore_mezzo_liquidabile',
        'rilievi',
        'data_chiusura',
        'importo_sospeso',
        'data_sospeso',
        'stato_avanzamento',
        
        'data_sinistro',
        'ora_sinistro',
        'luogo_sinistro',
        'autorita',
        'comando_autorita',
        'testimoni',
        'rivalsa',
        'soccorso',
        'tipologia_intervento',
        'danno_presunto',
        'numero_sinistro',
        
        'assicurazione_risarcente',
        'assicurazione_responsabile',
        'mezzo_visibile',
        'dinamica_sinistro',
        'note',
    ];
    
    
    /**
     *  Ritorna le pratiche relative al cliente
     *
     */
    public function clienti()
    {
        return $this->belongsTo('\App\Cliente', 'cliente_id');
    }
}
