@extends('layouts.app')

@section('content')
    <link href="{{ URL::asset('css/lib/dropzone.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::asset('js/lib/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dropzone_config.js') }}"></script>
    
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
                    @include ('common._dropdown_selezione_filiale')
                </div>
            </div>
        </div>

        @include('common._barra_filiale')
        @include('common.errors')

        <div class="panel panel-default col-md-6 col-md-offset-3">
            <div class="panel-body">
                {!! Form::open(['action' => ['DocumentiController@store', 'filiale' => $filiale], 'files' => true, 'class' => 'dropzone', 'id' => 'myDropzone']) !!}
                <select name="categoria">
                    <option value="1">Old</option>
                    <option value="2" selected>Posta entrata/uscita</option>
                    <option value="3">Certificazioni mediche</option>
                    <option value="4">Atti vari</option>
                    <option value="5">Perizie medico legale</option>
                </select>
                {{ Form::close() }}
                <p class="text-center">I documenti devono essere chiamati nel formato <code class="text-nowrap">&lt;num. pratica&gt;&nbsp;&lt;descrizione file&gt;</code></p>
            </div>
        </div>
    </div>
@endsection
