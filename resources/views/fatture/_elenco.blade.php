<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-eur"></i>
        &nbsp;
        Fatture pratica
    </div>

    <div class="panel-body">
        @if (count($fatture) > 0)
            <table class="table table-hover table-striped">
                <thead>
                    <th>Filiale</th>
                    <th>Numero</th>
                    <th>Dettaglio prestazione</th>
                    <th>Importo netto</th>
                    <th>Importo esente</th>
                    <th>Data emissione</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($fatture as $fattura)
                        <tr class="">
                            <td class="table-text"><div>{{ $fattura->nomeFiliale }}</div></td>
                            <td class="table-text"><div>{{ $fattura->numero }}</div></td>
                            <td class="table-text"><div>{{ $fattura->dettaglio_prestazione }}</div></td>
                            <td class="table-text"><div>{{ format_money($fattura->importo_netto) }}</div></td>
                            <td class="table-text"><div>{{ format_money($fattura->importo_esente) }}</div></td>
                            <td class="table-text">{{ format_date($fattura->data_emissione) }}</td>
                            
                            <td class="table-text col-md-2">
                                <a href="{{ action('FattureController@show',
                                    ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'fattura' => $fattura]) }}"
                                    class="btn btn-default">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                
                                <a href="{{ action('FattureController@edit',
                                    ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'fattura' => $fattura]) }}"
                                    class="btn btn-primary">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Non sono presenti fatture relative alla pratica.</p>
        @endif
        
        <div class="text-center">
            <a class="btn btn-success" href="{{ action('FattureController@create',
                    ['cliente' => $pratica->cliente, 'pratica' => $pratica]) }}">
                <i class="fa fa-fw fa-plus"></i>
                Aggiungi fattura
            </a>
        </div>
    </div>
</div>