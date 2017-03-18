@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Elenco Pratiche</h1>
        <div class="panel panel-default queryPanel">
            <div class="panel-heading">
                Query
                <i class="fa fa-fw fa-caret-down pull-right"></i>
            </div>
            <div class="panel-body">
                <script>
                    var queryFields = {!! json_encode($queryFields) !!};
                </script>
                
                {{ Form::open(['action' => ['PraticheController@filter'], 'class' => 'form-horizontal', 'id' => 'queryForm']) }}
                
                    <div class="form-group">
                        <label for="numero_pratica" class="col-md-3 control-label">Numero pratica</label>
                        <div class="col-md-7">
                            <input type="text" name="numero_pratica" class="form-control"> 
                        </div>
                        <a class="btn btn-default deleteQueryRow"><i class="fa fa-fw fa-times"></i></a>
                    </div>
                
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-1">
                            <select id="newFieldQuerySelect" class="form-control" placeholder="Aggiungi nuovo campo">
                                <option></option>
                                @foreach ($queryFields as $name => $f)
                                    <option value="{{ $name }}">{{ $f['display'] }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6 text-center">
                            <button type="submit" id="queryBtn" class="btn btn-primary">
                                   <i class="fa fa-fw fa-search"></i>
                                   Cerca
                            </button>
                            <a href="{{ action('PraticheController@index') }}" class="btn btn-default">
                                   <i class="fa fa-times"></i> 
                            </a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>

        <div class="panel panel-default">
            <!-- Lista pratiche -->
            <div class="panel-body" id="queryResult">
            </div>
        </div>
       
    </div>
@endsection