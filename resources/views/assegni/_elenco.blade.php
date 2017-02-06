<!-- Elenco assegni relativi alla pratica -->
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-credit-card"></i>
        &nbsp;
        Assegni pratica
    </div>

    <div class="panel-body">
        @if (count($assegni) > 0)
            <table class="table table-hover table-striped">
                <thead>
                    <th>Data</th>
                    <th>Importo</th>
                    <th>Banca</th>
                    <th>Consegnato il</th>
                    <th>Restituito il</th>
                    <th>Scadenza</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($assegni as $index => $assegno)
                        <tr>
                            <td class="table-text"><div>{{ format_date($assegno->data) }}</div></td>
                            <td class="table-text"><div>{{ format_money($assegno->importo) }}</div></td>
                            <td class="table-text"><div>{{ $assegno->banca }}</div></td>
                            <td class="table-text"><div>{{ $assegno->tipologia ? '' : format_date($assegno->data_azione) }}</div></td>
                            <td class="table-text"><div>{{ $assegno->tipologia ? format_date($assegno->data_azione) : '' }}</div></td>
                            <td class="table-text"><div>{{ $assegno->data_scadenza ? format_date($assegno->data_scadenza) : '' }}</div></td>
                            
                            <td class="table-text">
                                <!-- Form eliminazione pratica -->
                                {{ Form::open(['action' => ['AssegniController@destroy',
                                    'cliente' => $assegno->pratica->cliente, 'pratica' => $assegno->pratica, 'assegno' => $assegno],
                                    'id' => "assegno{$assegno->id}DestroyForm", 'method' => 'delete']) }}
                                {{ Form::close() }}
                                <!-- Fine form eliminazione pratica -->
                                
                                <a class="btn btn-primary" href="{{ action('AssegniController@edit',
                                    ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'assegno' => $assegno ]) }}">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </a>
                                
                                <a href="#" class="btn btn-danger showAssegnoDestroyModal"
                                    data-toggle="modal" data-target="#assegnoDestroyModal" data-assegno="{{$assegno->id}}">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mb-5 totali-assegni">
                <div class="col-md-2 col-md-offset-2">
                    <strong>Totale consegnato</strong>
                     <p>{{ format_money($totale_assegni_consegnati) }}</p>
                </div>
                <div class="col-md-1">
                    <h4>&minus;</h4>
                </div>
                <div class="col-md-2">
                    <strong>Totale restituito</strong>
                    <p>{{ format_money($totale_assegni_restituiti) }}</p>
                </div>
                <div class="col-md-1">
                    <h4>=</h4>
                </div>
                <div class="col-md-2">
                    <strong>Differenza</strong>
                    <p>{{ format_money($totale_assegni_consegnati - $totale_assegni_restituiti) }}</p>
                </div>
            </div>
        @else
            <p>Non sono presenti assegni relativi alla pratica.</p>
        @endif
        <div class="text-center">
            <a class="btn btn-success" href="{{ action('AssegniController@create',
                    ['cliente' => $pratica->cliente, 'pratica' => $pratica]) }}">
                <i class="fa fa-fw fa-plus"></i>
                Aggiungi assegno
            </a>
        </div>
    </div>
</div>