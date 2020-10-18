@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Modifica Pagamento
            </h1>
            <div>
                <div class="pull-left">
                    <a href="{{ action('PraticheController@show', ['cliente' => $pagamento->pratica->cliente, 'pratica' => $pagamento->pratica] ) }}"
                        class="btn btn-default"><i class="fa fa-fw fa-arrow-left"></i></a>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>

        <div class="col-md-offset-1 col-md-10">
            <!-- Mostra errori di validazione -->
            @include('common.errors')
            
            @include('pagamenti._form')
        </div>
    </div>
@endsection
