@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Modifica Pratica
            </h1>
            <div>
                <div class="pull-left">
                    <a href="{{ action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                        class="btn btn-default"><i class="fa fa-fw fa-arrow-left"></i></a>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>
        
        <!-- Mostra errori di validazione -->
        @include('common.errors')
        
        <!-- Solo se admin -->
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-id-card"></i>
                &nbsp;
                Filiale: {{ $pratica->cliente->filiale->nome }}
            </div>
        </div>
        
        <!-- Riepilogo utente -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-user"></i>
                &nbsp;
                Dati Utente
            </div>

            <div class="panel-body">
                    
                <div class="row">
                    
                    <!-- Cognome cliente -->
                    <strong class="col-md-2 form-control-static">Cognome</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->cliente->nome }}</p>
                    </div>
                    
                    <!-- Nome cliente -->
                    <strong class="col-md-2 form-control-static">Nome</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->cliente->nome }}</p>
                    </div>
                </div>
                
                
                <div class="row">
                    <!-- Codice fiscale -->
                    <strong class="col-md-2 form-control-static">Codice fiscale</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $pratica->cliente->codice_fiscale }}</p>
                    </div>
                    
                    <!-- Professione -->
                    <strong class="col-md-2 form-control-static">Professione</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">Professione1</p>
                    </div>
                </div>
                
                
                <div class="row">
                    <!-- Reddito -->    
                    <strong class="col-md-2 form-control-static">Reddito</strong>
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($pratica->cliente->reddito) ? $pratica->cliente->reddito . " €" : '' }}</p>
                    </div>
                </div>
            </div>
        </div>

        @include('partials._form_pratica')
        
    </div>
@endsection
