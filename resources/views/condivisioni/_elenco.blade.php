<!-- Elenco condivisioni per la pratica -->
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-share-alt"></i>
        &nbsp;
        Condivisione accesso
    </div>

    <div class="panel-body">
        <p>
            Le filiali qui elencate saranno in grado di:
            <ul>
                <li>Visualizzare e modificare (ma non eliminare) la pratica</li>
                <li>Visualizzare e modificare (ma non eliminare) il cliente della pratica</li>
                <li>Caricare documenti per la pratica</li>
                <li>Generare lettere per la pratica (solo se hanno il permesso di generare lettere)</li>
            </ul>
        </p>
        @php
            $filialiConAccesso = $pratica->filialiConAccesso->filter(function ($filiale) {
                return $filiale->utente && $filiale->utente->enabled;
            });
        @endphp
        @if (count($filialiConAccesso) > 0)
            <table class="table table-hover table-striped">
                <thead>
                    <th>Filiali con accesso</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($filialiConAccesso as $filiale)
                        <tr>
                            <td class="table-text">
                                <div>
                                    {{ $filiale->nome }}
                                </div>
                            </td>
                            <td class="table-text col-md-2">
                                {{ Form::open([
                                    'action' => [
                                                    'CondivisioniController@destroy',
                                                    'cliente' => $pratica->cliente,
                                                    'pratica' => $pratica,
                                                    'filiale' => $filiale
                                                ],
                                    'method' => 'delete'
                                ]) }}
                                    <button class="btn btn-danger">
                                        <i class="fa fa-fw fa-trash"></i>
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Non sono presenti condivisioni per questa pratica.</p>
        @endif
        <div class="text-center">
            {{ Form::open([
                'action' => [
                                'CondivisioniController@store',
                                'cliente' => $pratica->cliente,
                                'pratica' => $pratica,
                            ],
                'method' => 'post',
                'class' => 'form-inline',
            ]) }}
                <div class="form-group" style="min-width: 25rem; margin-top: 5px;">
                    {{ Form::select('filiale', $filialiSenzaAccesso->pluck('nome', 'id')) }}
                </div>
                <button class="btn btn-success">
                    <i class="fa fa-fw fa-share-alt"></i>
                    Condividi accesso
                </button>
            {{ Form::close() }}
        </div>
    </div>
</div>
