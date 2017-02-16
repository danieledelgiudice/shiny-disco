@extends('layouts.app')

@section('content')
    @include('promemoria._modal_update')

    <div class="container">
        <div class="page-header text-center">
            <h1>Agenda di oggi</h1>
            <div>
                <div class="pull-left">
                </div>
                <div class="pull-right">
                    @include ('common._dropdown_selezione_filiale', ['mostraOpzioneTutte' => '0'])
                </div>
            </div>
        </div>
        <div>
            @include('common._barra_filiale')
            <div class="panel panel-default">
                <!-- Lista promemoria da completare -->
                <div class="panel-body">
                    <table class="table table-striped {{ $da_confermare ? '' : 'table-selectable' }}">
                        <thead>
                            {{ Form::open(['action' => ['PromemoriaController@filter', 'filiale' => $filiale], 'class' => 'form-horizontal', 'id' => 'queryForm']) }}
                            <th class="col-md-2">
                                Chi
                                <br>
                                <!--{{ Form::text('chi', null, [ 'class' => 'form-control agenda-filter']) }}-->
                                {{ Form::select('chi', $chis, null, ['class' => 'form-control agenda-filter', 'data-selecttype' => 'chi', 'placeholder' => '']) }}
                            </th>
                            <th class="col-md-2">
                                Quando
                                <br>
                                <div class="input-group date">
                                    {!! Form::text('quando', null, ['class' => 'form-control date-control', 'required' => 'required']) !!}
                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                </div>
                            </th>
                            <th class="col-md-5"><p style="margin-bottom: 32px">Cosa</p></th>
                            <th class="col-md-1">&nbsp;</th>
                            <th class="col-md-1">
                                <a href="{{ Request::url() }}" class="btn btn-default">
                                   <i class="fa fa-times fa-fw"></i> 
                                </a>
                            </th>
                            <th class="col-md-1">
                                <button class="btn btn-primary" id="queryBtn">
                                   <i class="fa fa-search fa-fw"></i> 
                                </button>
                            </th>
                            {{ Form::close() }}
                        </thead>
                        <tbody id="queryResult">
                            @include('promemoria._tabella')
                        </tbody>
                    </table>
                    
                    @if (!$da_confermare)
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-8">
                                    <div class="input-group date">
                                        {!! Form::text('spostaPromemoriaQuando', null, ['class' => 'form-control date-control', 'required' => 'required', 'id' => 'spostaPromemoriaQuando']) !!}
                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button id="spostaPromemoriaBtn" class="btn btn-primary">Sposta selezione</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            @if ($da_confermare)
                <div class="text-center">
                    {{ Form::open(['action' => 'PromemoriaController@confermaLettura']) }}
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-fw fa-check"></i>
                            Confermo di aver letto l'agenda di oggi
                        </button>
                    {{ Form::close() }}
                </div>
            @endif
        </div>
    </div>
@endsection