@extends('layouts.app', ['background_color' => 'rgb(229, 255, 188)'])

@section('content')
    @include('common._modal_elimina',
       ['resource' => 'pratica',
        'message' => 'Sei sicuro di voler eliminare la pratica? Questa operazione non potrà essere annullata.'])
    
    @include('common._modal_elimina',
       ['resource' => 'documento',
        'message' => 'Sei sicuro di voler eliminare il documento? Questa operazione non potrà essere annullata.'])
        
    @include('common._modal_elimina',
       ['resource' => 'pagamento',
        'message' => 'Sei sicuro di voler eliminare il pagamento? Questa operazione non potrà essere annullata.'])
        
    @include('common._modal_elimina',
       ['resource' => 'assegno',
        'message' => 'Sei sicuro di voler eliminare l\'assegno? Questa operazione non potrà essere annullata.'])
    
    @include('common._modal_elimina',
       ['resource' => 'prestazioneMedica',
        'message' => 'Sei sicuro di voler eliminare la prestazione medica? Questa operazione non potrà essere annullata.'])
    
    @include('promemoria._modal_create')
    
    @include('promemoria._modal_update')

    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Dettagli Pratica
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
                    <a href="{{ action('ClientiController@show', ['cliente' => $pratica->cliente] ) }}"
                        class="btn btn-default"><i class="fa fa-fw fa-user"></i></a>
                </div>
                <div class="pull-right">
                    <!-- Form eliminazione pratica -->
                    {{ Form::open(['action' => ['PraticheController@destroy', 'cliente' => $pratica->cliente, 'pratica' => $pratica],
                        'id' => 'praticaDestroyForm', 'method' => 'delete']) }}
                    {{ Form::close() }}
                    <!-- Fine form eliminazione pratica -->

                    @can('condividere-pratica', $pratica)
                    <a href="{{ action('CondivisioniController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                        class="btn btn-success"><i class="fa fa-fw fa-share-alt"></i></a>
                    @endcan
                    
                    @if (Auth::user()->canGenerateLetters())
                        <a href="{{ action('LettereController@showOptions', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                            class="btn btn-default"><i class="fa fa-fw fa-envelope"></i></a>
                    @endif
                    
                    <a href="{{ action('PraticheController@edit', ['cliente' => $pratica->cliente, 'pratica' => $pratica] ) }}"
                        class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i></a>
                    
                    @can('eliminare-pratica', $pratica)
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#praticaDestroyModal">
                        <i class="fa fa-fw fa-trash"></i>
                    @endcan
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
        
        <!-- Elenco pagamenti pratica -->
        @include('pagamenti._elenco')
        
        <!-- Elenco assegni pratica -->
        @include('assegni._elenco')
        
        <!-- Elenco prestazioni mediche pratica -->
        @include('prestazioni_mediche._elenco')
        
        
        @can('generare-fatture')
            <!-- Elenco fatture -->
            @include('fatture._elenco')
        @endcan
        
        <!-- Elenco promemoria pratica -->
        @include('promemoria._elenco')
    </div>
@endsection
