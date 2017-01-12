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
        
        @if ( Auth::user()->isAdmin() )
        <!-- Solo se admin -->
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-id-card"></i>
                &nbsp;
                Filiale: {{ $pratica->cliente->filiale->nome }}
            </div>
        </div>
        @endif
        
        <!-- Riepilogo utente -->
        @include('clienti._riepilogo')

        @include('pratiche._form')
        
    </div>
@endsection
