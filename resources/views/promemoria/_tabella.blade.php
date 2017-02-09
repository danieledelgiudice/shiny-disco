@if (count($promemoria) > 0)
    @foreach ($promemoria as $p)
        <tr>
            <td class="table-text col-md-2"><p data-fieldName="chi">{{ $p->chi }}</p></td>
            <td class="table-text col-md-2"><p data-fieldName="quando">{{ date_diff_days($p->quando) }}</p></td>
            <td class="table-text col-md-5"><p data-fieldName="cosa">{{ $p->cosa }}</p></td>
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
                <a class="btn btn-default" href="{{ action('PraticheController@show', 
                    ['cliente' => $p->pratica->cliente, 'pratica' => $p->pratica])}}">
                    <i class="fa fa-fw fa-eye"></i>
                </a>
            </td>
            <td class="col-md-1">
                {!! Form::open(['action' => ['PromemoriaController@destroy', 'cliente' => $p->pratica->cliente,
                    'pratica' => $p->pratica, 'promemoria' => $p], 'method' => 'delete']) !!}
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-fw fa-check"></i>
                    </button>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    <script>
        var promemoria = {!! json_encode($promemoria->keyBy('id')) !!};
    </script>
@endif