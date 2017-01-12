<!-- Elenco assegni relativi alla pratica -->
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-sticky-note"></i>
        &nbsp;
        Assegni pratica
    </div>

    <div class="panel-body">
        @if (count($assegni) > 0)
            <table class="table table-hover table-striped">
                <thead>
                    <th class="text-center">#</th>
                    <th>Data</th>
                    <th>Importo</th>
                    <th>Banca</th>
                    <th>Consegnato il</th>
                    <th>Restituito il</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($assegni as $index => $assegno)
                        <tr class="">
                            <td class="table-text"><div class="text-center">{{ $index+1 }}</div></td>
                            <td class="table-text"><div>{{ format_date($assegno->data) }}</div></td>
                            <td class="table-text"><div>{{ $assegno->importo }} €</div></td>
                            <td class="table-text"><div>{{ $assegno->banca }}</div></td>
                            <td class="table-text"><div>{{ $assegno->tipologia ? '' : format_date($assegno->data_azione) }}</div></td>
                            <td class="table-text"><div>{{ $assegno->tipologia ? format_date($assegno->data_azione) : '' }}</div></td>
                            
                            <td class="table-text">
                                <!-- Form eliminazione pratica -->
                                {{ Form::open(['action' => ['AssegniController@destroy',
                                    'cliente' => $assegno->pratica->cliente, 'pratica' => $assegno->pratica, 'assegno' => $assegno],
                                    'id' => "assegno{$assegno->id}DestroyForm", 'method' => 'delete']) }}
                                {{ Form::close() }}
                                <!-- Fine form eliminazione pratica -->
                                
                                <a class="btn btn-success" href="{{ action('AssegniController@edit',
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