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
                    <a href="{{ action('ClientiController@show', ['cliente' => $pratica->cliente] ) }}"
                        class="btn btn-default"><i class="fa fa-fw fa-user"></i></a>
                </div>
                <div class="pull-right">
                    <a href="{{ action('PraticheController@edit', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                        class="btn btn-success"><i class="fa fa-fw fa-pencil"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Mostra errori di validazione -->
        @include('common.errors')

        <!-- Solo se admin -->
        @if ( Auth::user()->isAdmin() )
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-id-card"></i>
                &nbsp;
                Filiale: {{ $pratica->cliente->filiale->nome }}
            </div>
        </div>
        @endif
        
        <!-- Riepilogo utente -->
        @include('partials._riepilogo_cliente')
        
        <!-- Dettagli pratica -->
        @include('partials._dettagli_pratica')
        
        <!-- Elenco documenti pratica -->
        @include('partials._elenco_documenti_pratica')
        
        <!-- Elenco assegni pratica -->
        @include('partials._elenco_assegni_pratica')
    </div>
@endsection
