<!-- Elenco pagamenti relativi alla pratica -->
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-dollar"></i>
        &nbsp;
        Pagamenti pratica
    </div>

    <div class="panel-body">
        @if (count($pagamenti) > 0)
            <table class="table table-hover table-striped">
                <thead>
                    <th>Data</th>
                    <th>Importo</th>
                    <th>Cose</th>
                    <th>Persone</th>
                    <th>Spese mediche</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($pagamenti as $index => $pagamento)
                        <tr>
                            <td class="table-text col-md-2"><div>{{ format_date($pagamento->data) }}</div></td>
                            <td class="table-text col-md-2"><div>{{ format_money($pagamento->importo) }}</div></td>
                            <td class="table-text col-md-2"><div>{{ $pagamento->cose ? '✔' : '' }}</div></td>
                            <td class="table-text col-md-2"><div>{{ $pagamento->persone ? '✔' : '' }}</div></td>
                            <td class="table-text col-md-2"><div>{{ $pagamento->spese_mediche ? '✔' : '' }}</div></td>
                            
                            <td class="table-text col-md-2">
                                <!-- Form eliminazione pratica -->
                                {{ Form::open(['action' => ['PagamentiController@destroy',
                                    'cliente' => $pagamento->pratica->cliente, 'pratica' => $pagamento->pratica, 'pagamento' => $pagamento],
                                    'id' => "pagamento{$pagamento->id}DestroyForm", 'method' => 'delete']) }}
                                {{ Form::close() }}
                                <!-- Fine form eliminazione pratica -->
                                
                                <a class="btn btn-primary" href="{{ action('PagamentiController@edit',
                                    ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'pagamento' => $pagamento ]) }}">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </a>
                                
                                <a href="#" class="btn btn-danger showPagamentoDestroyModal"
                                    data-toggle="modal" data-target="#pagamentoDestroyModal" data-pagamento="{{$pagamento->id}}">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Non sono presenti pagamenti relativi alla pratica.</p>
        @endif
        <div class="text-center">
            <a class="btn btn-success" href="{{ action('PagamentiController@create',
                    ['cliente' => $pratica->cliente, 'pratica' => $pratica]) }}">
                <i class="fa fa-fw fa-plus"></i>
                Aggiungi pagamento
            </a>
        </div>
    </div>
</div>
