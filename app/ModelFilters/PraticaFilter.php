<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class PraticaFilter extends ModelFilter
{
    public $relations = [
        'cliente' => [
            'cognome',
            'nome',
            'citta_nascita',
            'data_nascita',
            'sesso',
            'codice_fiscale',
            'via',
            'citta_residenza',
            'provincia',
            'cap',
            'partita_iva',
            'stato_civile',
            'tipo_documento',
            'numero_documento',
            'professione_id',
            'dettagli_professione',
            'reddito',
            'numero_card',
            'filiale_id',
            'importante',
        ]
    ];

    public function numeroPratica($value)
    {
        if (is_array($value)) {
            $q = $this;

            if ($value[0])
                $q = $q->where('numero_pratica', '>=', $value[0]);
            if ($value[1])
                $q = $q->where('numero_pratica', '<=', $value[1]);

            return $q;
        }

        return $this->whereBeginsWith('numero_pratica', $value);
    }

    public function numeroPraticaRange($value)
    {
        if (!is_array($value)) {
            return $this;
        }

        $q = $this;

        if (isset($value[0]) && $value[0] !== '')
            $q = $q->where('numero_pratica', '>=', $value[0]);
        if (isset($value[1]) && $value[1] !== '')
            $q = $q->where('numero_pratica', '<=', $value[1]);

        return $q;
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

    public function statoAvanzamento($value)
    {
        return $this->where('stato_avanzamento', $value);
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
        return $this->whereLike('assicurazione_parte', $value);
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

    public function proprietarioMezzoParte($value)
    {
        return $this->whereBeginsWith('proprietario_mezzo_parte', $value);
    }

    public function assicurazioneControparte($value)
    {
        return $this->whereLike('assicurazione_controparte', $value);
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

    public function onorari($value)
    {
        if (!$value[1]) return $this;

        $op = ($value[0] == 'lt') ? '<=' : '>=';

        return $this->where('onorari', $op, $value[1]);
    }

    public function luquidatoOmnia($value)
    {
        if (!$value[1]) return $this;

        $op = ($value[0] == 'lt') ? '<=' : '>=';

        return $this->where('liquidato_omnia', $op, $value[1]);
    }

    public function dataSinistro($value)
    {
        // if (!$value[1]) return $this;

        // $op = ($value[0] == 'lt') ? '<=' : '>=';
        // $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value);

        //return $this->where('data_sinistro', '=', $element);
        $this->whereDate('data_sinistro', '=', $element->toDateString());
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


    public function dataPrescrizione($value)
    {
        if (!$value[1]) return $this;

        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);

        return $this->where('data_prescrizione', $op, $element);
    }

    public function dataProssimaUdienza($value)
    {
        if (!$value[1]) return $this;

        $op = ($value[0] == 'lt') ? '<=' : '>=';
        $element = \Carbon\Carbon::createFromFormat('d/m/Y', $value[1]);

        return $this->where('data_prossima_udienza', $op, $element);
    }

    public function segnalatoDa($value)
    {
        return $this->whereBeginsWith('segnalato_da', $value);
    }

    ///////////////////////////////////////


    public function clienteCognome($value)
    {
        return $this->push('cognome', $value);
    }

    public function clienteNome($value)
    {
        return $this->push('nome', $value);
    }

    public function clienteCittaNascita($value)
    {
        return $this->push('citta_nascita', $value);
    }

    public function clienteDataNascita($value)
    {
        return $this->push('data_nascita', $value);
    }

    public function clienteSesso($value)
    {
        return $this->push('sesso', $value);
    }

    public function clienteCodiceFiscale($value)
    {
        return $this->push('codice_fiscale', $value);
    }

    public function clienteVia($value)
    {
        return $this->push('via', $value);
    }

    public function clienteCittaResidenza($value)
    {
        return $this->push('citta_residenza', $value);
    }

    public function clienteProvincia($value)
    {
        return $this->push('provincia', $value);
    }

    public function clienteCap($value)
    {
        return $this->push('cap', $value);
    }

    public function clientePartitaIva($value)
    {
        return $this->push('partita_iva', $value);
    }

    public function clienteStatoCivile($value)
    {
        return $this->push('stato_civile', $value);
    }

    public function clienteTipoDocumento($value)
    {
        return $this->push('tipo_documento', $value);
    }

    public function clienteNumeroDocumento($value)
    {
        return $this->push('numero_documento', $value);
    }

    public function clienteProfessione($value)
    {
        return $this->push('professione_id', $value);
    }

    public function clienteDettagliProfessione($value)
    {
        return $this->push('dettagli_professione', $value);
    }

    public function clienteReddito($value)
    {
        return $this->push('reddito', $value);
    }

    public function clienteNumeroCard($value)
    {
        return $this->push('numero_card', $value);
    }

    public function clienteFiliale($value)
    {
        return $this->push('filiale_id', $value);
    }

    public function clienteImportante($value)
    {
        return $this->push('importante', $value);
    }
}
