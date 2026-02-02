@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Modifica Pratica
            </h1>
            <p class="text-center text-muted">
                {{ $pratica->numero_pratica }} numero sinistro {{ $pratica->numero_sinistro }}
            </p>
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
        
        @include('common._barra_filiale')
        
        <!-- Riepilogo utente -->
        @include('clienti._riepilogo')

        @include('pratiche._form')
        
    </div>
@endsection
