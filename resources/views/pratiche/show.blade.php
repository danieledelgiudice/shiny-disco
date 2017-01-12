@extends('layouts.app')

@section('content')
    @include('common._modal_elimina',
       ['resource' => 'pratica',
        'message' => 'Sei sicuro di voler eliminare la pratica? Questa operazione non potrà essere annullata.'])
    
    @include('common._modal_elimina',
       ['resource' => 'assegno',
        'message' => 'Sei sicuro di voler eliminare l\'assegno? Questa operazione non potrà essere annullata.'])

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
                    
                    <a href="{{ action('PraticheController@edit', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                        class="btn btn-success"><i class="fa fa-fw fa-pencil"></i></a>
                    
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
    </div>
@endsection
