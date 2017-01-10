@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Modifica Cliente
            </h1>
            <div>
                <div class="pull-left">
                    <a href="{{ action('ClientiController@show', ['cliente' => $cliente] ) }}"
                        class="btn btn-default"><i class="fa fa-fw fa-arrow-left"></i></a>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>

        <div>
            <!-- Mostra errori di validazione -->
            @include('common.errors')
            
            <!-- Solo se admin -->
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-id-card"></i>
                    &nbsp;
                    Filiale: {{ $cliente->filiale->nome }}
                </div>
            </div>
    
            @include('partials._form_cliente')
        </div>
    </div>
@endsection
