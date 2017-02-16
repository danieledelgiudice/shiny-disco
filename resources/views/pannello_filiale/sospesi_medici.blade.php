@extends('pannello_filiale._dashboard', ['active' => 'sospesi_medici'])
@section('inner-content')

<div class="panel panel-default">
    <!-- Lista pratiche -->
    <div class="panel-body">
        <table class="table table-hover table-striped">
            <thead>
                <th>Numero pratica</th>
                <th class="hidden-xs">Medico</th>
                <th class="hidden-xs">Importo</th>
                <th class="hidden-xs">%</th>
                <th class="hidden-xs">Quantità percentuale</th>
                <th>A pagare</th>
                <th>&nbsp;</th>
            </thead>
            @if (count($prestazioni) > 0)
                <tbody>
                    @foreach ($prestazioni as $p)
                        <tr>
                            <td class="table-text"><div>{{ $p->pratica->numero_pratica }}</div></td>
                            <td class="table-text"><div>{{ $p->nome_medico }}</div></td>
                            <td class="table-text"><div>{{ format_money($p->costo) }}</div></td>
                            <td class="table-text"><div>{{ $p->percentuale . '%'}}</div></td>
                            <td class="table-text"><div>{{ format_money($p->quantitaPercentuale) }}</div></td>
                            <td class="table-text"><div>{{ format_money($p->aPagare) }}</div></td>
                            <td class="table-text">
                                <a href="{{ action('PraticheController@show', ['cliente' => $p->pratica->cliente, 'pratica' => $p->pratica]) }}" class="btn btn-default">
                                   <i class="fa fa-eye"></i> 
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                    <tr class="orange row-subtotal">
                        <td>Totale</td>
                        <td></td>
                        <td>{{ format_money($prestazioni->sum('costo')) }}</td>
                        <td></td>
                        <td>{{ format_money($prestazioni->sum('quantitaPercentuale')) }}</td>
                        <td>{{ format_money($prestazioni->sum('aPagare')) }}</td>
                        <td></td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>
</div>

@endsection