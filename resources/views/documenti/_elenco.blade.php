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
                    <table class="table table-hover table-striped documenti-table">
                        <thead>
                            <th></th>
                            <th>Nome documento</th>
                            <th>Data inserimento</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach ($documenti_categoria as $documento)
                                <tr>
                                    <td class="table-text col-md-1 text-center">
                                        <input type="checkbox" class="toDeleteDocument"
                                            data-documento="{{ $documento->id }}"
                                            data-descrizione="{{ $documento->descrizione }}" />
                                    </td>
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

        <div class="text-right">
            <button class="btn btn-danger showDocumentiMultipliDestroyModal hidden" data-toggle="modal" data-target="#documentiMultipliDestroyModal">
                Elimina selezionati
                <i class="fa fa-fw fa-trash"></i>
            </button>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="documentiMultipliDestroyModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="text-center modal-title">Attenzione!</h4>
                    </div>
                    <div class="modal-body">
                        <p>Sei sicuro di voler eliminare i seguenti documenti?</p>
                        <ul id="descrizioniList"></ul>
                        <p>Questa operazione non potrà essere annullata.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                        <button type="button" class="btn btn-danger" id="documentiMultipliDestroyConfirm">Elimina i documenti</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            <{{ Form::open(['action' => ['DocumentiController@destroyMultiple',
            'cliente' => $pratica->cliente, 'pratica' => $pratica],
            'id' => "documentiMultipliDestroyForm", 'method' => 'delete']) }}
            <div class="documenti"></div>
        {{ Form::close()}}
        </div><!-- /.modal -->
        
        @if (count($documenti) == 0)
            <p>Non sono presenti documenti relativi alla pratica.</p>
        @endif
    </div>
</div>
