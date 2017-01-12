@extends('layouts.app')

@section('content')
    @include('common._modal_elimina',
       ['resource' => 'cliente',
        'message' => 'Sei sicuro di voler eliminare il cliente? Questa operazione non potrà essere annullata.'])

    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Dettagli Cliente
            </h1>
            <div>
                <div class="pull-left">
                    <a href="{{ action('ClientiController@index') }}"
                        class="btn btn-default"><i class="fa fa-fw fa-users"></i></a>
                </div>
                <div class="pull-right">
                    <!-- Form eliminazione cliente -->
                    {{ Form::open(['action' => ['ClientiController@destroy', 'cliente' => $cliente],
                        'id' => 'clienteDestroyForm', 'method' => 'delete']) }}
                    {{ Form::close() }}
                    <!-- Fine form eliminazione cliente -->
                    
                    <a href="{{ action('ClientiController@edit', $cliente) }}" class="btn btn-success"><i class="fa fa-fw fa-pencil"></i></a>
                    
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#clienteDestroyModal">
                        <i class="fa fa-fw fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
       
        <div>
            <!-- Mostra errori di validazione -->
            @include('common.errors')
    
            @include('common._barra_filiale')
    
            @include('clienti._dettagli')
            
            @include('pratiche._elenco')
        </div>
    </div>
@endsection
