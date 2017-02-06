@if (count($pratiche) > 0)
    <p class="pull-right">{{ count($pratiche) }} risultati.</p>
    <table class="table table-hover table-striped table-filterable">
        <thead>
            @for ($i = 0; $i < 6; $i++)
                @if ($requestedFields[$i])
                <th>{{ $queryFields[$requestedFields[$i]]['display'] }}</th>
                @endif
            @endfor
            
            <th class="col-md-2">&nbsp;</th>
        </thead>
        <tbody>
            @foreach ($pratiche as $pratica)
                <tr>
                    @for ($i = 0; $i < 6; $i++)
                        @if ($requestedFields[$i])
                        <td class="table-text col-md-2" data-field="{{ $requestedFields[$i] }}">
                            <div>{{ format_field($queryFields, $pratica, $requestedFields[$i]) }}</div>
                        </td>
                        @endif
                    @endfor
                    
                    <!-- Dettagli/Modifica pratica -->
                    <td class="col-md-2">
                        <a href="{{ action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica]) }}" class="btn btn-default">
                           <i class="fa fa-eye"></i> 
                        </a>
                        <a href="{{ action('PraticheController@edit', ['cliente' => $pratica->cliente, 'pratica' => $pratica])}}" class="btn btn-primary">
                           <i class="fa fa-pencil"></i> 
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-center">Non sono presenti pratiche</p>
@endif