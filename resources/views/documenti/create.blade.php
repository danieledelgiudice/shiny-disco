@extends('layouts.app')

@section('content')
    <link href="{{ URL::asset('css/lib/dropzone.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('js/lib/dropzone.js') }}"></script>
    
    <div class="container">
        <!-- Mostra pulsanti navigazione -->
        <div class="page-header">
            <h1 class="text-center">
                Inserimento nuovo documento
            </h1>
            <div>
                <div class="pull-left">
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>

        @include('common.errors')

        <div class="panel panel-default col-md-6 col-md-offset-3">
            <div class="panel-body">
                {!! Form::open(['action' => ['DocumentiController@store', 'cliente' => $cliente, 'pratica' => $pratica],
                    'files' => true, 'class' => 'dropzone', 'id' => 'myDropzone']) !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
