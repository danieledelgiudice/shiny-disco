<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PraticaFilter extends ModelFilter
{
    // stringa - iniziacon
    // public function cognome($value)
    // {
    //     return $this->whereBeginsWith('cognome', $value);
    // }
    
    // stringa - data
    // public function dataNascita($value)
    // {
    //     if (!$value[1]) return $this;
        
    //     $op = ($value[0] == 'lt') ? '<=' : '>=';
    //     $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
    //     return $this->where('data_nascita', $op, $element);
    // }
    
    // decimal
    // public function reddito($value)
    // {
    //     if (!$value[1]) return $this;
        
    //     $op = ($value[0] == 'lt') ? '<=' : '>=';

    //     return $this->where('reddito', $op, $value[1]);
    // }
    
    // enum o relazione
    // public function sesso(enum)/autorita(rel)($value)
    // {
    //     return $this->where('sesso/autorita_id', $value);
    // }
    
    // stringa - contiene
    // public function via($value)
    // {
    //     return $this->whereLike('via', $value);
    // }
    
    public function numeroPratica($value)
    {
        return $this->whereBeginsWith('numero_pratica', $value);
    }
    
    public function numeroRegistrazione($value)
    {
        return $this->whereBeginsWith('numero_registrazione', $value);
    }
    
    public function dataApertura($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
        return $this->where('data_apertura', $op, $element);
    }
    
    public function statoPratica($value)
    {
        return $this->where('stato_pratica', $value);
    }
     
    public function tipoPratica($value)
    {
        return $this->where('tipo_pratica', $value);
    }
     
    public function veicoloParte($value)
    {
        return $this->whereLike('veicolo_parte', $value);
    }
   
    public function targaParte($value)
    {
        return $this->whereBeginsWith('targa_parte', $value);
    }
    
    public function numeroPolizzaParte($value)
    {
        return $this->whereBeginsWith('numero_polizza_parte', $value);
    }
    
    public function assicurazioneParte($value)
    {
        return $this->where('assicurazione_parte_id', $value);
    }
    
    public function conducenteControparte($value)
    {
        return $this->whereLike('conducente_controparte', $value);
    }
    
    public function viaControparte($value)
    {
        return $this->whereLike('via_controparte', $value);
    }
  
    public function cittaControparte($value)
    {
        return $this->whereBeginsWith('citta_controparte', $value);
    }    
    
    public function telefonoControparte($value)
    {
        return $this->whereLike('telefono_controparte', $value);
    }
    
    public function veicoloControparte($value)
    {
        return $this->whereLike('veicolo_controparte', $value);
    }
    
    public function targaControparte($value)
    {
        return $this->whereBeginsWith('targa_controparte', $value);
    }
    
    public function numeroPolizzaControparte($value)
    {
        return $this->whereBeginsWith('numero_polizza_controparte', $value);
    }    

    public function proprietarioMezzoResponsabile($value)
    {
        return $this->whereBeginsWith('proprietario_mezzo_responsabile', $value);
    }    
    
     public function assicurazioneControparte($value)
    {
        return $this->where('assicurazione_controparte_id', $value);
    }
    
    public function liquidatore($value)
    {
        return $this->whereLike('liquidatore', $value);
    }
    
    public function parcellaPresunta($value)
    {
         if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';

        return $this->where('parcella_presunta', $op, $value[1]);
    }
    
    public function legale($value)
    {
        return $this->whereLike('legale', $value);
    }
    
    public function inData($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
        return $this->where('in_data', $op, $element);
    }
    
    public function controllato($value)
    {
        return $this->where('controllato', $value);
    }
    
    public function dataUltimaLettera($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
        return $this->where('data_ultima_lettera', $op, $element);
    }
    
    public function mezzoLiquidato($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
        return $this->where('mezzo_liquidato', $op, $element);
    }
    
    public function valoreMezzoLiquidato($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';

        return $this->where('valore_mezzo_liquidato', $op, $value[1]);
    }
    
    public function rilievi($value)
    {
        return $this->where('rilievi', $value);
    }
    
    public function dataChiusura($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
        return $this->where('data_chiusura', $op, $element);
    }
    
    public function dataSospeso($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
        return $this->where('data_sospeso', $op, $element);
    }
    
    public function importoSospeso($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';

        return $this->where('importo_sospeso', $op, $value[1]);
    }
    
    public function onorariOmnia($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';

        return $this->where('onorari_omnia', $op, $value[1]);
    }
    
    public function luquidatoOmnia($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';

        return $this->where('liquidato_omnia', $op, $value[1]);
    }
    
    public function dataSinistro($value)
    {
        if (!$value[1]) return $this;
        
        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        
        return $this->where('data_sinistro', $op, $element);
    }
   
   public function luogoSinistro($value)
    {
        return $this->whereLike('luogo_sinistro', $value);
    } 
    
    public function testimoni($value)
    {
        return $this->whereLike('testimoni', $value);
    }
    
    public function autorita($value)
    {
        return $this->where('autorita_id', $value);
    }
    
    public function comandoAutorita($value)
    {
        return $this->whereLike('comando_autorita', $value);
    }
    
    public function rivalsa($value)
    {
        return $this->where('rivalsa', $value);
    }
    
    public function soccorso($value)
    {
        return $this->where('soccorso', $value);
    }
    
    public function tipologiaIntervento($value)
    {
        return $this->where('tipologia_intervento', $value);
    }
    
    public function assicurazioneResponsabile($value)
    {
        return $this->whereLike('assicurazione_responsabile', $value);
    }
    
    public function assicurazioneRisarcente($value)
    {
        return $this->whereLike('assicurazione_risarcente', $value);
    }
    
   public function numeroSinistro($value)
    {
        return $this->whereBeginsWith('numero_sinistro', $value);
    }  
}