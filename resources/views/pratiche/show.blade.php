@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Dettagli Pratica
            </h1>
            <div>
                <div class="pull-left">
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>
        
        <!-- Mostra errori di validazione -->
        @include('common.errors')

        <!-- Dettagli pratica -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-file-text"></i>
                &nbsp;
                Dati Pratica
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    
                    <!-- Numero pratica -->
                    <strong class="col-md-2 form-control-static">Numero pratica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_pratica }}</p>
                    </div>
                    
                    <!-- Numero registrazione -->
                    <strong class="col-md-2 form-control-static">Numero registrazione</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_registrazione }}</p>
                    </div>
                </div>
                
                
                <div class="row">
                    <!-- Data apertura -->
                    <strong class="col-md-2 form-control-static">Data apertura</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->data_apertura instanceof \Carbon\Carbon) ? $pratica->data_apertura->format('m/d/Y') : '' }}</p>
                    </div>
                    
                    <!-- Stato pratica -->
                    <strong class="col-md-2 form-control-static">Stato pratica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumStatoPratica[$pratica->stato_pratica] }}</p>
                    </div>
                </div>
                
                
                <div class="row">
                    <!-- Tipo pratica -->    
                    <strong class="col-md-2 form-control-static">Tipo pratica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumTipoPratica[$pratica->tipo_pratica] }}</p>
                    </div>
                </div>
            </div>
        </div>
                    
        <div class="panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-user"></i>
                &nbsp;
                Dettagli parte
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    <!-- Veicolo di parte -->
                    <strong class="col-md-2 form-control-static">Veicolo di parte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->veicolo_parte }}</p>
                    </div>
                
                    <!-- Targa di parte -->
                    <strong class="col-md-2 form-control-static">Targa di parte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->targa_parte }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Numero polizza di parte -->
                    <strong class="col-md-2 form-control-static">Numero polizza di parte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_polizza_parte }}</p>
                    </div>
                    
                    <!-- Assicurazione di parte -->
                    <strong class="col-md-2 form-control-static">Assicurazione di parte</strong>
                    <div class="col-md-4">
                       <p class="form-control-static">{{ $pratica->assicurazione_parte }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-danger">
            <div class="panel-heading">
                <i class="fa fa-user-secret"></i>
                &nbsp;
                Dettagli controparte
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    <!-- Nominativo controparte -->
                    <strong class="col-md-2 form-control-static">Nominativo controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->nominativo_controparte }}</p>
                    </div>
                
                    <!-- Via controparte -->
                    <strong class="col-md-2 form-control-static">Via controparte</strong>
                    <div class="col-md-4">
                       <p class="form-control-static">{{ $pratica->via_controparte }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Città controparte -->
                    <strong class="col-md-2 form-control-static">Città controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->citta_controparte }}</p>
                    </div>
                    
                    <!-- Telefono controparte -->
                    <strong class="col-md-2 form-control-static">Telefono controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->telefono_controparte }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Veicolo controparte -->
                    <strong class="col-md-2 form-control-static">Veicolo controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->veicolo_controparte }}</p>
                    </div>
                
                    <!-- Targa controparte -->
                    <strong class="col-md-2 form-control-static">Targa controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->targa_controparte }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Numero polizza controparte -->
                    <strong class="col-md-2 form-control-static">Numero polizza controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_polizza_controparte }}</p>
                    </div>
                
                    <!-- Proprietario mezzo responsabile -->
                    <strong class="col-md-2 form-control-static">Proprietario mezzo reponsabile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->proprietario_mezzo_responsabile }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Assicurazione controparte -->
                    <strong class="col-md-2 form-control-static">Assicurazione controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->assicurazione_controparte }}</p>
                    </div>
                
                    <!-- Medico controparte -->
                    <strong class="col-md-2 form-control-static">Medico controparte</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->medico_controparte }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-folder-open"></i>
                &nbsp;
                Dettagli pratica
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    <!-- Legale -->
                    <strong class="col-md-2 form-control-static">Legale</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->legale }}</p>
                    </div>
                
                    <!-- In data -->
                    <strong class="col-md-2 form-control-static">In data</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->in_data instanceof \Carbon\Carbon) ? $pratica->in_data->format('m/d/Y') : '' }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Controllato -->
                    <strong class="col-md-2 form-control-static">Controllato</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumControllato[$pratica->controllato] }}</p>
                    </div>
                    
                    <!-- Data ultima lettera -->
                    <strong class="col-md-2 form-control-static">Data ultima lettera</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->data_ultima_lettera instanceof \Carbon\Carbon) ? $pratica->data_ultima_lettera->format('m/d/Y') : '' }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Mezzo Liquidabile -->
                    <strong class="col-md-2 form-control-static">Mezzo liquidabile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumMezzoLiquidabile[$pratica->mezzo_liquidabile] }}</p>
                    </div>
                
                    <!-- Valore mezzo liquidabile -->
                    <strong class="col-md-2 form-control-static">Valore mezzo liquidabile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->valore_mezzo_liquidabile }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Rilievi -->
                    <strong class="col-md-2 form-control-static">Rilievi</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumRilievi[$pratica->rilievi] }}</p>
                    </div>
                
                    <!-- Data chiusura -->
                    <strong class="col-md-2 form-control-static">Data chiusura</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->data_chiusura instanceof \Carbon\Carbon) ? $pratica->data_chiusura->format('m/d/Y') : '' }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Importo sospeso -->
                    <strong class="col-md-2 form-control-static">Importo sospeso</strong>
                    <div class="col-md-4">
                       <p class="form-control-static">{{ $pratica->importo_sospeso }}</p>
                    </div>
                
                    <!-- Data sospeso -->
                    <strong class="col-md-2 form-control-static">Data sospeso</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->data_sospeso instanceof \Carbon\Carbon) ? $pratica->data_sospeso->format('m/d/Y') : '' }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Stato avanzamento pratica -->
                    <strong class="col-md-2 form-control-static">Stato avanzamento pratica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumStatoAvanzamento[$pratica->stato_avanzamento] }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-handshake-o"></i>
                &nbsp;
                Informazioni sinistro
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    <!-- Data sinistro -->
                    <strong class="col-md-2 form-control-static">Data sinistro</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->data_sinistro instanceof \Carbon\Carbon) ? $pratica->data_sinistro->format('m/d/Y') : '' }}</p>
                    </div>
                
                    <!-- Orario sinistro -->
                    <strong class="col-md-2 form-control-static">Orario sinistro</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->ora_sinistro }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Luogo sinistro -->
                    <strong class="col-md-2 form-control-static">Luogo sinistro</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->luogo_sinistro }}</p>
                    </div>
                    
                    <!-- Testimoni -->
                    <strong class="col-md-2 form-control-static">Testimoni</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->testimoni }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Autorità -->
                    <strong class="col-md-2 form-control-static">Autorità</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumAutorita[$pratica->autorita] }}</p>
                    </div>
                
                    <!-- Comando di -->
                    <strong class="col-md-2 form-control-static">Comando di</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->comando_autorita }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Rivalsa -->
                    <strong class="col-md-2 form-control-static">Rivalsa</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumRivalsa[$pratica->rivalsa] }}</p>
                    </div>
                
                    <!-- Soccorso -->
                    <strong class="col-md-2 form-control-static">Soccorso</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->enumSoccorso[$pratica->soccorso] }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Tipologia intervento -->
                    <strong class="col-md-2 form-control-static">Tipologia intervento</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->tipologia_intervento }}</p>
                    </div>
                
                    <!-- Danno presunto -->
                    <strong class="col-md-2 form-control-static">Danno presunto</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->danno_presunto }}</p>

                    </div>
                </div>
                
                <div class="row">
                    <!-- Assicurazione responsabile -->
                    <strong class="col-md-2 form-control-static">Assicurazione responsabile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->assicurazione_responsabile }}</p>
                    </div>
                
                    <!-- Assicurazione risarcente -->
                    <strong class="col-md-2 form-control-static">Assicurazione risarcente</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->assicurazione_risarcente }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Numero sinistro -->
                    <strong class="col-md-2 form-control-static">Numero sinistro</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->numero_sinistro }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Mezzo visibile -->
                    <strong class="col-md-2 form-control-static">Mezzo visibile</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->mezzo_visibile }}</p>
                    </div>
                    
                    <!-- Dinamica -->
                    <strong class="col-md-2 form-control-static">Dinamica</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->dinamica }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Note -->
                    <strong class="col-md-2 form-control-static">Note</strong>
                    <div class="col-md-10">
                       <p class="form-control-static">{{ $pratica->note }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection