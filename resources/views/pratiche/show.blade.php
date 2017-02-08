@extends('layouts.app', ['background_color' => 'rgb(229, 255, 188)'])

@section('content')
    @include('common._modal_elimina',
       ['resource' => 'pratica',
        'message' => 'Sei sicuro di voler eliminare la pratica? Questa operazione non potrà essere annullata.'])
    
    @include('common._modal_elimina',
       ['resource' => 'documento',
        'message' => 'Sei sicuro di voler eliminare il documento? Questa operazione non potrà essere annullata.'])
        
    @include('common._modal_elimina',
       ['resource' => 'assegno',
        'message' => 'Sei sicuro di voler eliminare l\'assegno? Questa operazione non potrà essere annullata.'])
    
    @include('common._modal_elimina',
       ['resource' => 'prestazioneMedica',
        'message' => 'Sei sicuro di voler eliminare la prestazione medica? Questa operazione non potrà essere annullata.'])
    
    @include('promemoria._modal_create')

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
                    <!-- Form eliminazione pratica -->
                    {{ Form::open(['action' => ['PraticheController@destroy', 'cliente' => $pratica->cliente, 'pratica' => $pratica],
                        'id' => 'praticaDestroyForm', 'method' => 'delete']) }}
                    {{ Form::close() }}
                    <!-- Fine form eliminazione pratica -->
                    
                    @if (Auth::user()->canGenerateLetters())
                        <a href="{{ action('LettereController@showOptions', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                            class="btn btn-default"><i class="fa fa-fw fa-envelope"></i></a>
                    @endif
                    
                    <a href="{{ action('PraticheController@edit', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                        class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i></a>
                    
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#praticaDestroyModal">
                        <i class="fa fa-fw fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Mostra errori di validazione -->
        @include('common.errors')

        @include('common._barra_filiale')
        
        <!-- Riepilogo utente -->
        @include('clienti._riepilogo')
        
        <!-- Dettagli pratica -->
        @include('pratiche._dettagli')
        
        <!-- Elenco documenti pratica -->
        @include('documenti._elenco')
        
        <!-- Elenco assegni pratica -->
        @include('assegni._elenco')
        
        <!-- Elenco prestazioni mediche pratica -->
        @include('prestazioni_mediche._elenco')
        
        <!-- Elenco promemoria pratica -->
        @include('promemoria._elenco')
    </div>
@endsection
