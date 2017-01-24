@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-header text-center">Elenco Clienti</h1>
        <div class="panel panel-default queryPanel">
            <div class="panel-heading">
                Query
                <i class="fa fa-fw fa-caret-down pull-right"></i>
            </div>
            <div class="panel-body" style="display: none">
                <script>
                    var queryFields = {!! json_encode($queryFields) !!};
                </script>
                
                {{ Form::open(['action' => ['ClientiController@filter'], 'class' => 'form-horizontal', 'id' => 'queryForm']) }}
                
                    <!--<div class="form-group">-->
                    <!--    <div class="col-md-4 col-md-offset-1">-->
                    <!--        <select id="newFieldQuerySelect" class="form-control" data-selecttype="none">-->
                    <!--            <option></option>-->
                    <!--            @foreach ($queryFields as $name => $f)-->
                    <!--                <option value="{{ $name }}">{{ $f['display'] }}</option>-->
                    <!--            @endforeach-->
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <div class="form-group">
                        <div class="dropdown col-md-2 col-md-offset-1" id="newFieldQueryDropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                Aggiungi nuovo attributo
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($queryFields as $name => $f)
                                    <li><a href="#" data-name="{{ $name }}">{{ $f['display'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-8 text-center">
                            <button type="submit" id="queryBtn" class="btn btn-primary">
                                   <i class="fa fa-fw fa-search"></i>
                                   Cerca
                            </button>
                            <a href="{{ action('ClientiController@index') }}" class="btn btn-default">
                                   <i class="fa fa-times"></i> 
                            </a>
                        </div>
                    </div>
                
                    <!--<div class="form-group">-->
                    <!--    <label for="$name" class="col-md-4">$display</label>-->
                    <!--    <input type="text" name="$name" class="form-control"> -->
                    <!--</div>-->
                    
                    <!--<p>-->
                    <!--    Nome-->
                    <!--    <br>-->
                    <!--    {{ Form::text('nome', null, [ 'class' => 'form-control']) }}-->
                    <!--</p>-->
                    
                    <!--<p>-->
                    <!--    Codice Fiscale-->
                    <!--    <br>-->
                    <!--    {{ Form::text('codice_fiscale', null, [ 'class' => 'form-control']) }}-->
                    <!--</p>-->
                    
                    <!--<p>-->
                    <!--    Professione-->
                    <!--    <br>-->
                    <!--    {{ Form::select('professione', $professioni, null, [ 'placeholder' => '', 'class' => 'form-control' ]) }}-->
                    <!--</p>-->
                    
                    <!--<p>-->
                    <!--    Filiale-->
                    <!--    <br>-->
                    <!--    {{ Form::select('filiale', $filiali, null, [ 'placeholder' => '', 'class' => 'form-control' ]) }}-->
                    <!--</p>-->
                    
                    <div class="form-group">
                        <div class="text-center">
                            
                        </div>
                    </div>
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
@endsection