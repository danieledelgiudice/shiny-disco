@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Modifica Pratica
            </h1>
            @php
                $subtitleParts = [];
                $subtitleSeparator = ' <span class="subtitle-sep" style="border-left:1px solid #999; margin:0 8px;"></span> ';
                if (!empty($pratica->numero_pratica)) {
                    $subtitleParts[] = '<strong>Numero pratica:</strong> ' . e($pratica->numero_pratica);
                }
                if (!empty($pratica->data_sinistro)) {
                    $subtitleParts[] = '<strong>Data sinistro:</strong> ' . e(format_date($pratica->data_sinistro));
                }
                if (!empty($pratica->numero_sinistro)) {
                    $subtitleParts[] = '<strong>Numero sinistro:</strong> ' . e($pratica->numero_sinistro);
                }
            @endphp
            @if (!empty($subtitleParts))
                <p class="text-center text-muted">
                    {!! implode($subtitleSeparator, $subtitleParts) !!}
                </p>
            @endif
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
