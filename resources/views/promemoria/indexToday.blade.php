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
                    @include ('common._dropdown_selezione_filiale')
                </div>
            </div>
        </div>
        <div>
            @include('common._barra_filiale')
            <div class="panel panel-default">
                <!-- Lista promemoria da completare -->
                <div class="panel-body">
                    <table class="table table-hover table-striped">
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
                                {{ Form::select('quando', ['Oggi', 'Ultima settimana', 'Ultimo mese', 'Ultimo anno', 'Qualsiasi data'], null, ['class' => 'form-control agenda-filter', 'data-selecttype' => 'quando']) }}
                            </th>
                            <th class="col-md-5"><p style="margin-bottom: 32px">Cosa</p></th>
                            <th class="col-md-1">&nbsp;</th>
                            <th class="col-md-1">
                                <a href="{{ action('PromemoriaController@indexToday', ['filiale' => $filiale]) }}" class="btn btn-default">
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