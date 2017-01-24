@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Elenco Clienti</h1>
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Query
                </div>
                <div class="panel-body">
                    <script>
                        var queryFields = {!! json_encode($queryFields) !!};
                    </script>
                    
                    {{ Form::open(['action' => ['ClientiController@filter'], 'class' => 'form-horizontal', 'id' => 'queryForm']) }}
                        <p>
                            Cognome
                            <br>
                            {{ Form::text('cognome', null, [ 'class' => 'form-control']) }}
                        </p>
                        
                        <p>
                            Nome
                            <br>
                            {{ Form::text('nome', null, [ 'class' => 'form-control']) }}
                        </p>
                        
                        <p>
                            Codice Fiscale
                            <br>
                            {{ Form::text('codice_fiscale', null, [ 'class' => 'form-control']) }}
                        </p>
                        
                        <p>
                            Professione
                            <br>
                            {{ Form::select('professione', $professioni, null, [ 'placeholder' => '', 'class' => 'form-control' ]) }}
                        </p>
                        
                        <p>
                            Filiale
                            <br>
                            {{ Form::select('filiale', $filiali, null, [ 'placeholder' => '', 'class' => 'form-control' ]) }}
                        </p>
                        
                        <p>
                            <a href="{{ action('ClientiController@index') }}" class="btn btn-default">
                                   <i class="fa fa-times"></i> 
                            </a>
                            <button type="submit" id="queryBtn" class="btn btn-primary">
                                   <i class="fa fa-fw fa-search"></i>
                            </button>
                        </p>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="panel panel-default">
                <!-- Lista clienti -->
                <div class="panel-body" id="queryResult">
                    @include('clienti._tabella')
                </div>
            </div>
        </div>
    </div>
@endsection