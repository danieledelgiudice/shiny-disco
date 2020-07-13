<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-sticky-note"></i>
        &nbsp;
        Documenti pratica
    </div>

    <div class="panel-body">
        @php ($categorie = [1 => 'Old', 2 => 'Posta entrata/uscita', 3 => 'Certificazioni mediche', 4 => 'Atti vari', 5 => 'Perizia medico legale'])
        @foreach ($documenti->groupBy('categoria') as $categoria => $documenti_categoria)
            <div class="document-category">
                <h4 class="document-category-header">
                    <span><i class="chevron fa fa-chevron-down"></i></span>
                    &nbsp;
                    {{ $categorie[$categoria] }}
                </h4>
                <div class="document-category-content">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>Nome documento</th>
                            <th>Data inserimento</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($documenti_categoria as $documento)
                                <tr>
                                    <td class="table-text"><div>{{ $documento->descrizione }}</div></td>
                                    <td class="table-text col-md-2"><div>{{ format_date($documento->created_at) }}</div></td>
                                    
                                    <td class="table-text col-md-2">
                                        <!-- Form eliminazione pratica -->
                                        {{ Form::open(['action' => ['DocumentiController@destroy',
                                            'cliente' => $documento->pratica->cliente, 'pratica' => $documento->pratica, 'documento' => $documento],
                                            'id' => "documento{$documento->id}DestroyForm", 'method' => 'delete']) }}
                                        {{ Form::close() }}
                                        <!-- Fine form eliminazione pratica -->
                                        
                                        <a class="btn btn-default" target="_blank" href="{{ action('DocumentiController@show',
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
                </div>
            </div>
            <hr>
        @endforeach
        
        @if (count($documenti) == 0)
            <p>Non sono presenti documenti relativi alla pratica.</p>
        @endif
    </div>
</div>