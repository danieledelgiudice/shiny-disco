<div class="panel panel-info">
    <div class="panel-heading">
        <i class="fa fa-folder-open"></i>
        &nbsp;
        Elenco pratiche
    </div>
    <div class="panel-body">
        @if (count($pratiche) > 0)
            <div class="panel-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Numero pratica</th>
                        <th>Stato pratica</th>
                        <th>Tipo pratica</th>
                        <th>Data apertura</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($pratiche as $pratica)
                            <tr class="">
                                <td class="table-text"><div>{{ $pratica->numero_pratica }}</div></td>
                                <td class="table-text"><div>{{ \App\Pratica::$enumStatoPratica[$pratica->stato_pratica] }}</div></td>
                                <td class="table-text"><div>{{ \App\Pratica::$enumTipoPratica[$pratica->tipo_pratica] }}</div></td>
                                <td class="table-text"><div>{{ format_date($pratica->data_apertura) }}</div></td>

                                <!-- Dettagli/Modifica pratica -->
                                <td>
                                    <a href="{{ action('PraticheController@show', ['cliente' => $pratica->cliente,
                                        'pratica' => $pratica])}}" class="btn btn-default">
                                       <i class="fa fa-eye"></i> 
                                    </a>
                                    <a href="{{ action('PraticheController@edit', ['cliente' => $pratica->cliente,
                                        'pratica' => $pratica])}}" class="btn btn-primary">
                                       <i class="fa fa-pencil"></i> 
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Non sono presenti pratiche relative al cliente.</p>
        @endif
        <div class="">
            <a id="aggiungi-pratica-button" class="btn btn-success center-block"
                href="{{ action('PraticheController@create', ['cliente' => $cliente]) }}">
                <i class="fa fa-plus fa-btn"></i>
                Aggiungi pratica
            </a>
        </div>
    </div>
</div>