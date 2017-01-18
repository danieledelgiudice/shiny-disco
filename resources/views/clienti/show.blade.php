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
                @if($cliente->importante)
                    <a class="" id="toggleImportanteBtn"><i class="fa fa-fw fa-star" style="color: gold"></i></a>
                @else
                    <a class="" id="toggleImportanteBtn"><i class="fa fa-fw fa-star-o" style="color: #AAAAAA"></i></a>
                @endif
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
                    
                    <!-- Form toggle importante -->
                    {{ Form::open(['action' => ['ClientiController@toggleImportante', 'cliente' => $cliente],
                        'id' => 'toggleImportanteForm', 'method' => 'put']) }}
                    {{ Form::close() }}
                    <!-- Fine form toggle importante -->
                    
                    
                    
                    <a href="{{ action('ClientiController@edit', $cliente) }}" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i></a>
                    
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
