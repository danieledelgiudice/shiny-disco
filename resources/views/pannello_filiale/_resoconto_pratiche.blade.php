<div class="panel panel-default">
    <!-- Lista pratiche -->
    <div class="panel-body">
        <table class="table table-hover table-striped">
            <thead>
                <th>Numero pratica</th>
                <th class="hidden-xs">Data apertura</th>
                <th class="hidden-xs">Stato pratica</th>
                <th class="hidden-xs">Tipo pratica</th>
                <th>{{ $nome_campo_h }}</th>
                <th>&nbsp;</th>
            </thead>
            @if (count($pratiche) > 0)
                <tbody>
                    @foreach ($pratiche as $p)
                        <tr>
                            <td class="table-text"><div>{{ $p->numero_pratica }}</div></td>
                            <td class="table-text"><div>{{ format_date($p->data_apertura) }}</div></td>
                            <td class="table-text"><div>{{ isset(\App\Pratica::$enumStatoPratica[$p->stato_pratica]) ? \App\Pratica::$enumStatoPratica[$p->stato_pratica] : '' }}</div></td>
                            <td class="table-text"><div>{{ isset(\App\Pratica::$enumTipoPratica[$p->tipo_pratica]) ? \App\Pratica::$enumTipoPratica[$p->tipo_pratica] : '' }}</div></td>
                            <td class="table-text"><div>{{ format_money($p->{$nome_campo}) }}</div></td>
                            <td class="table-text">
                                <a href="{{ action('PraticheController@show', ['cliente' => $p->cliente, 'pratica' => $p]) }}" class="btn btn-default">
                                   <i class="fa fa-eye"></i> 
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                    <tr class="orange row-subtotal">
                        <td>Totale</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ format_money($pratiche->sum($nome_campo)) }}</td>
                        <td></td>
                    </tr>
                    
                </tbody>
            @endif
        </table>
    </div>
</div>