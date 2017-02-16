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
                @can('modificare-agenda', $pratica)
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                @endcan
            </thead>
            <tbody>
                @foreach ($promemoria as $p)
                    <tr>
                        <td class="table-text col-md-2"><p data-fieldName="chi">{{ $p->chi }}</p></td>
                        <td class="table-text col-md-2"><p data-fieldName="quando">{{ date_diff_days($p->quando) }}</p></td>
                        <td class="table-text col-md-6"><p data-fieldName="cosa">{{ $p->cosa }}</p></td>
                        
                        @can('modificare-agenda', $pratica)
                            <td class="table-text col-md-1">
                                {{ Form::open(['action' => ['PromemoriaController@update',
                                    'cliente' => $p->pratica->cliente, 'pratica' => $p->pratica, 'promemoria' => $p],
                                    'id' => "promemoria{$p->id}UpdateForm", 'method' => 'put']) }}
                                    <input type='hidden' name='chi' value=''>
                                    <input type='hidden' name='quando' value=''>
                                    <input type='hidden' name='cosa' value=''>
                                {{ Form::close() }}
                                <button class="btn btn-primary promemoriaUpdateBtn" data-toggle="modal" data-target="#promemoriaUpdateModal" data-promemoria="{{$p->id}}">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </button>
                            </td>
                            <td class="col-md-1">
                                {!! Form::open(['action' => ['PromemoriaController@destroy', 'cliente' => $p->pratica->cliente,
                                    'pratica' => $p->pratica, 'promemoria' => $p], 'method' => 'delete']) !!}
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-fw fa-check"></i>
                                    </button>
                                {!! Form::close() !!}
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-center">Non sono presenti promemoria da completare per questa pratica</p>
        @endif
        <div class="text-center">
            @can('modificare-agenda', $pratica)
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createPromemoriaModal">
                    <i class="fa fa-fw fa-plus"></i>
                    Aggiungi promemoria
                </button>
            @endcan
        </div>
    </div>
    <script>
        var promemoria = {!! json_encode($promemoria->keyBy('id')) !!};
    </script>
</div>

