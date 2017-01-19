<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-sticky-note"></i>
        &nbsp;
        Documenti pratica
    </div>

    <div class="panel-body">
        @if (count($documenti) > 0)
            <table class="table table-hover table-striped">
                <thead>
                    <th>Nome documento</th>
                    <th>Data inserimento</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($documenti as $documento)
                        <tr class="">
                            <td class="table-text"><div>{{ $documento->descrizione }}</div></td>
                            <td class="table-text col-md-2"><div>{{ format_date($documento->created_at) }}</div></td>
                            
                            <td class="table-text col-md-2">
                                <!-- Form eliminazione pratica -->
                                {{ Form::open(['action' => ['DocumentiController@destroy',
                                    'cliente' => $documento->pratica->cliente, 'pratica' => $documento->pratica, 'documento' => $documento],
                                    'id' => "documento{$documento->id}DestroyForm", 'method' => 'delete']) }}
                                {{ Form::close() }}
                                <!-- Fine form eliminazione pratica -->
                                
                                <a class="btn btn-default" href="{{ action('DocumentiController@show',
                                    ['cliente' => $pratica->cliente, 'pratica' => $pratica, 'documento' => $documento ]) }}">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                
                                <a href="#" class="btn btn-danger showDocumentoDestroyModal"
                                    data-toggle="modal" data-target="#documentoDestroyModal" data-documento="{{$documento->id}}">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Non sono presenti documenti relativi alla pratica.</p>
        @endif
    </div>
</div>