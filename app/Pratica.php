<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use Collective\Html\Eloquent\FormAccessible;

class Pratica extends Model
{
    use FormAccessible;
    use Filterable;
    
    protected $table = 'pratiche';
    
    protected static function boot() {
        parent::boot();

        static::deleting(function($pratica) {
            foreach($pratica->assegni as $assegno) {
                $assegno->delete();
            }
            foreach($pratica->documenti as $documento) {
                $documento->delete();
            }
            foreach($pratica->promemoria()->withTrashed()->get() as $promemoria) {
                $promemoria->forceDelete();
            }
            foreach($pratica->prestazioni_mediche as $prestazione_medica) {
                $prestazione_medica->delete();
            }
        });
    }
    
    public function cliente()
    {
        return $this->belongsTo('\App\Cliente', 'cliente_id');
    }
    
    public function documenti()
    {
        return $this->hasMany('\App\Documento', 'pratica_id', 'id');
    }
    
    public function assegni()
    {
        return $this->hasMany('\App\Assegno', 'pratica_id', 'id');
    }
    
    public function assicurazione_parte()
    {
        return $this->belongsTo('\App\CompagniaAssicurativa', 'assicurazione_parte_id');
    }
    
    public function assicurazione_controparte()
    {
        return $this->belongsTo('\App\CompagniaAssicurativa', 'assicurazione_controparte_id');
    }
    
    public function autorita()
    {
        return $this->belongsTo('\App\Autorita', 'autorita_id');
    }
    
    public function promemoria()
    {
        return $this->hasMany('\App\Promemoria', 'pratica_id', 'id');
    }
    
    public function prestazioni_mediche()
    {
        return $this->hasMany('\App\PrestazioneMedica', 'pratica_id', 'id');
    }
    
    // Mutator data_apertura
    public function setDataAperturaAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_apertura'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_apertura'] = null;
        else
            $this->attributes['data_apertura'] = $value;
    }

    // Mutator in_data
    public function setInDataAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['in_data'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['in_data'] = null;
        else
            $this->attributes['in_data'] = $value;
    }

    // Mutator data_ultima_lettera
    public function setDataUltimaLetteraAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_ultima_lettera'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_ultima_lettera'] = null;
        else
            $this->attributes['data_ultima_lettera'] = $value;
    }
    
    // Mutator data_chiusura
    public function setDataChiusuraAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_chiusura'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_chiusura'] = null;
        else
            $this->attributes['data_chiusura'] = $value;
    }
    
    // Mutator data_sospeso
    public function setDataSospesoAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_sospeso'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_sospeso'] = null;
        else
            $this->attributes['data_sospeso'] = $value;
    }
    
    // Mutator data_sinistro
    public function setDataSinistroAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['data_sinistro'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['data_sinistro'] = null;
        else
            $this->attributes['data_sinistro'] = $value;
    }
    
    // Mutator mezzo_liquidato
    public function setMezzoLiquidatoAttribute($value)
    {
        if (is_string($value) && $value !== '')
            $this->attributes['mezzo_liquidato'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
        else if ($value === '')
            $this->attributes['mezzo_liquidato'] = null;
        else
            $this->attributes['mezzo_liquidato'] = $value;
    }
    
    

    // Form Accessor data_apertura
    public function formDataAperturaAttribute($value)
    {
        return format_date($value);
    }
    
    // Form Accessor in_data
    public function formInDataAttribute($value)
    {
        return format_date($value);
    }
    
    // Form Accessor data_ultima_lettera
    public function formDataUltimaLetteraAttribute($value)
    {
        return format_date($value);
    }
    
    // Form Accessor data_chiusura
    public function formDataChiusuraAttribute($value)
    {
        return format_date($value);
    }
    
    // Form Accessor data_sospeso
    public function formDataSospesoAttribute($value)
    {
        return format_date($value);
    }
    
    // Form Accessor data_sospeso
    public function formDataSinistroAttribute($value)
    {
        return format_date($value);
    }
    
    // Form Accessor mezzo_liquidato
    public function formMezzoLiquidatoAttribute($value)
    {
        return format_date($value);
    }
    
    
    protected $dates = [
        'data_apertura',
        'in_data',
        'data_ultima_lettera',
        'data_chiusura',
        'data_sospeso',
        'data_sinistro',
        'mezzo_liquidato'
    ];
    
    
    public static $enumStatoPratica = [
		0 => 'Aperto',
		1 => 'Chiuso',
		2 => 'SS',
		3 => 'SS. Legale',
	];

    public static $enumTipoPratica = [
        0 => 'Sconosciuto',
		1 => 'RCA',
		2 => 'RCA Lesioni',
		3 => 'RCA Lesioni e Cose',
		4 => 'RCT',
		5 => 'Infortuni',
		6 => 'Malattia',
		7 => 'Globale Fabbricati', 
		8 => 'Trasporti Gommati',
		9 => 'Trasporti Navali', 
		10 => 'Trasporti su Rotaie', 
		11 => 'Penale',
		100 => 'Altro',
	];

	public static $enumControllato = [
		0 => 'No',
		1 => 'Sì',
	];

    public static $enumRilievi = [
		0 => 'Rilievi non necessari', 
		1 => 'Rilievi presi',
		2 => 'Rilievi da prendere',
		3 => 'Rilievi portati da cliente',
	];
    						
    public static $enumRivalsa = [
		0 => 'No rivalsa',
		1 => 'Da verificare',
		2 => 'Rivalsa INPS',
		3 => 'Rivalsa INAIL',
		4 => 'Rivalsa altre ass',
	];
    				
    public static $enumSoccorso = [
        0 => 'Nessuno',
		1 => 'Da solo', 
		2 => 'Da terzi',
		3 => 'Ambulanza',
		4 => 'Da parenti',
		5 => 'Dal responsabile',
	];
    
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

        'conducente_controparte',
        'via_controparte',
        'citta_controparte',
        'telefono_controparte',
        'veicolo_controparte',
        'targa_controparte',
        'numero_polizza_controparte',
        'proprietario_mezzo_responsabile',
        'medico_controparte',
        'luogo_medico_controparte',
        'data_medico_controparte',
        'liquidatore',
        'reperibilita_liquidatore',
        'parcella_presunta',
        
        'legale',
        'in_data',
        'controllato',
        'data_ultima_lettera',
        'mezzo_liquidato',
        'valore_mezzo_liquidato',
        'rilievi',
        'data_chiusura',
        'importo_sospeso',
        'data_sospeso',
        'liquidato_omnia',
        'onorari_omnia',
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
}
