<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-bell"></i>
        &nbsp;
        Elenco promemoria
    </div>
    <!-- Lista promemoria da completare -->
    <div class="panel-body">
        @if (count($promemoria) > 0)
        <table class="table table-hover table-striped">
            <thead>
                <th>Chi</th>
                <th>Quando</th>
                <th>Cosa</th>
                <th>&nbsp;</th>
            </thead>
            <tbody>
                @foreach ($promemoria as $p)
                    <tr>
                        <td class="table-text col-md-2"><div>{{ $p->chi }}</div></td>
                        <td class="table-text col-md-2"><div>{{ date_diff_days($p->quando) }}</div></td>
                        <td class="table-text col-md-6"><div>{{ $p->cosa }}</div></td>
                        <td class="col-md-2">
                            {!! Form::open(['action' => ['PromemoriaController@destroy', 'cliente' => $p->pratica->cliente,
                                'pratica' => $p->pratica, 'promemoria' => $p], 'method' => 'delete']) !!}
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-fw fa-check"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">Non sono presenti promemoria da completare per questa pratica</p>
        @endif
        <div class="text-center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createPromemoriaModal">
                <i class="fa fa-fw fa-plus"></i>
                Aggiungi promemoria
            </button>
        </div>
    </div>
</div>

