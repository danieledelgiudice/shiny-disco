@extends('pannello_filiale._dashboard', ['active' => 'fatture'])
@section('inner-content')

@include('common._modal_elimina',
       ['resource' => 'fattura',
        'message' => 'Sei sicuro di voler eliminare la fattura? Questa operazione non potrà essere annullata.'])

<div class="panel panel-default">
    <div class="panel-body">
        <!-- Lista fatture Elys -->
        <h4>Fatture Elys</h4>
        <table class="table table-hover table-striped">
            <thead>
                <th>Filiale</th>
                <th>Numero fattura</th>
                <th>Numero pratica</th>
                <th>Dettaglio prestazione</th>
                <th>Importo netto</th>
                <th>Importo esente</th>
                <th>Lordo incassato</th>
                <th>Data emissione</th>
                <th>&nbsp;</th>
            </thead>
            <tbody>
                @foreach ($fattureElys as $fattura)
                    <tr class="">
                        <td class="table-text"><div>{{ $fattura->appartenenza == 1 ? 'Ely\'s' : 'Elisir' }}</div></td>
                        <td class="table-text"><div>{{ $fattura->numero }}</div></td>
                        <td class="table-text">
                            <a href="{{ action('PraticheController@show',
                                ['cliente' => $fattura->pratica->cliente, 'pratica' => $fattura->pratica])}}">
                                <div>{{ $fattura->pratica->numero_pratica }}</div>    
                            </a>
                        </td>
                        <td class="table-text"><div>{{ $fattura->dettaglio_prestazione }}</div></td>
                        <td class="table-text"><div>{{ format_money($fattura->importo_netto) }}</div></td>
                        <td class="table-text"><div>{{ format_money($fattura->importo_esente) }}</div></td>
                        <td class="table-text"><div>{{ format_money($fattura->lordo_incassato) }}</div></td>
                        
                        <td class="table-text">{{ format_date($fattura->data_emissione) }}</td>
                        
                        <td class="table-text col-md-2">
                            <a href="{{ action('FattureController@show',
                                ['cliente' => $fattura->pratica->cliente, 'pratica' => $fattura->pratica, 'fattura' => $fattura]) }}"
                                class="btn btn-default">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            
                            <a href="{{ action('FattureController@edit',
                                    ['cliente' => $fattura->pratica->cliente, 'pratica' => $fattura->pratica, 'fattura' => $fattura]) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-fw fa-pencil"></i>
                            </a>
                            
                            <a href="#" class="btn btn-danger showFatturaDestroyModal"
                                    data-toggle="modal" data-target="#fatturaDestroyModal" data-fattura="{{$fattura->id}}">
                                <i class="fa fa-fw fa-trash"></i>
                            </a>
                            
                            {{ Form::open(['action' => ['FattureController@destroy', 'cliente' => $fattura->pratica->cliente,
                                           'pratica' => $fattura->pratica, 'fattura' => $fattura], 'method' => 'delete', 'style' => 'display:inline;',
                                           'id' => "fattura{$fattura->id}DestroyForm"]) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                <tr class="row-subtotal orange">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>{{ format_money($fattureElys->sum('importo_netto')) }}</th>
                    <th>{{ format_money($fattureElys->sum('importo_esente')) }}</th>
                    <th>{{ format_money($fattureElys->sum('lordo_incassato')) }}</th>
                    <th></th>
                    <th>&nbsp;</th>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <!-- Lista fatture Elisir -->
        <h4>Fatture Elisir</h4>
        <table class="table table-hover table-striped">
            <thead>
                <th>Filiale</th>
                <th>Numero fattura</th>
                <th>Numero pratica</th>
                <th>Dettaglio prestazione</th>
                <th>Importo netto</th>
                <th>Importo esente</th>
                <th>Lordo incassato</th>
                <th>Data emissione</th>
                <th>&nbsp;</th>
            </thead>
            <tbody>
                @foreach ($fattureElisir as $fattura)
                    <tr class="">
                        <td class="table-text"><div>{{ $fattura->appartenenza == 1 ? 'Ely\'s' : 'Elisir' }}</div></td>
                        <td class="table-text"><div>{{ $fattura->numero }}</div></td>
                        <td class="table-text">
                            <a href="{{ action('PraticheController@show',
                                ['cliente' => $fattura->pratica->cliente, 'pratica' => $fattura->pratica])}}">
                                <div>{{ $fattura->pratica->numero_pratica }}</div>    
                            </a>
                        </td>
                        <td class="table-text"><div>{{ $fattura->dettaglio_prestazione }}</div></td>
                        <td class="table-text"><div>{{ format_money($fattura->importo_netto) }}</div></td>
                        <td class="table-text"><div>{{ format_money($fattura->importo_esente) }}</div></td>
                        <td class="table-text"><div>{{ format_money($fattura->lordo_incassato) }}</div></td>
                        
                        <td class="table-text">{{ format_date($fattura->data_emissione) }}</td>
                        
                        <td class="table-text col-md-2">
                            <a href="{{ action('FattureController@show',
                                ['cliente' => $fattura->pratica->cliente, 'pratica' => $fattura->pratica, 'fattura' => $fattura]) }}"
                                class="btn btn-default">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <a href="{{ action('FattureController@edit',
                                    ['cliente' => $fattura->pratica->cliente, 'pratica' => $fattura->pratica, 'fattura' => $fattura]) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-fw fa-pencil"></i>
                            </a>
                            
                            <a href="#" class="btn btn-danger showFatturaDestroyModal"
                                    data-toggle="modal" data-target="#fatturaDestroyModal" data-fattura="{{$fattura->id}}">
                                <i class="fa fa-fw fa-trash"></i>
                            </a>
                            
                            {{ Form::open(['action' => ['FattureController@destroy', 'cliente' => $fattura->pratica->cliente,
                                           'pratica' => $fattura->pratica, 'fattura' => $fattura], 'method' => 'delete', 'style' => 'display:inline;',
                                           'id' => "fattura{$fattura->id}DestroyForm"]) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                <tr class="row-subtotal orange">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>{{ format_money($fattureElisir->sum('importo_netto')) }}</th>
                    <th>{{ format_money($fattureElisir->sum('importo_esente')) }}</th>
                    <th>{{ format_money($fattureElisir->sum('lordo_incassato')) }}</th>
                    <th></th>
                    <th>&nbsp;</th>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection