@if (count($clienti) > 0)
    <p class="pull-right">{{ $clienti->total() }} risultati.</p>
    <table class="table table-hover table-striped">
        <thead>
            @for ($i = 0; $i < 5; $i++)
                <th>{{ $queryFields[$requestedFields[$i]]['display'] }}</th>
            @endfor

            <th>&nbsp;</th>
        </thead>
        <tbody>
            @foreach ($clienti as $cliente)
                <tr>
                    @for ($i = 0; $i < 5; $i++)
                        <td class="table-text col-md-2" data-field="{{ $requestedFields[$i] }}">
                            <div>{{ format_field($queryFields, $cliente, $requestedFields[$i]) }}</div>
                        </td>
                    @endfor

                    <!-- Dettagli/Modifica cliente -->
                    <td>
                        <a href="{{ action('ClientiController@show', $cliente)}}" class="btn btn-default">
                           <i class="fa fa-eye"></i> 
                        </a>
                        <a href="{{ action('ClientiController@edit', $cliente)}}" class="btn btn-primary">
                           <i class="fa fa-pencil"></i> 
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="clienti links text-center">
        {{ $clienti->render() }}    
    </div>
@else
    <p class="text-center">Non sono presenti clienti</p>
@endif