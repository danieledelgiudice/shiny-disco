@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Modifica Filiale
            </h1>
            <div>
                <div class="pull-left">
                    <a href="{{ action('FilialiController@index') }}" class="btn btn-default"><i class="fa fa-fw fa-arrow-left"></i></a>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>

        <div class="col-md-offset-1 col-md-10">
            <!-- Mostra errori di validazione -->
            @include('common.errors')
            
            @include('filiali._form')
        </div>
    </div>
@endsection
