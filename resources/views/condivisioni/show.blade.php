@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Condividi accesso
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

        @include('condivisioni._elenco')
    </div>
@endsection
