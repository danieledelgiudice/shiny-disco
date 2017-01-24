@if (count($clienti) > 0)
    <p class="pull-right">{{ count($clienti) }} risultati.</p>
    <table class="table table-hover table-striped table-filterable">
        <thead>
            <th>Cognome</th>
            <th>Nome</th>
            
            @if (isset($requestedFields) && count($requestedFields) >= 3)
                <th>{{ $queryFields[$requestedFields[2]]['display'] }}</th>
            @else
                <th>Codice Fiscale</th>
            @endif
            
            
            @if (isset($requestedFields) && count($requestedFields) >= 2)
                <th>{{ $queryFields[$requestedFields[1]]['display'] }}</th>
            @else
                <th>Professione</th>
            @endif
            
            
            @if (isset($requestedFields) && count($requestedFields) >= 1)
                <th>{{ $queryFields[$requestedFields[0]]['display'] }}</th>
            @else
                <th>Filiale</th>
            @endif
            
            <th>&nbsp;</th>
        </thead>
        <tbody>
            @foreach ($clienti as $cliente)
                <tr>
                    <td class="table-text col-md-2" data-field="cognome"><div>{{ $cliente->cognome }}</div></td>
                    <td class="table-text col-md-2" data-field="nome"><div>{{ $cliente->nome }}</div></td>
                    
                    @if (isset($requestedFields) && count($requestedFields) >= 3)
                        <td class="table-text col-md-2" data-field="{{ $requestedFields[2] }}">
                            @if ($queryFields[$requestedFields[2]]['type'] === 'string')
                                <div>{{ $cliente->{$requestedFields[2]} }}</div>
                            @elseif ($queryFields[$requestedFields[2]]['type'] === 'date')
                                <div>{{ format_date($cliente->{$requestedFields[2]}) }}</div>
                            @elseif ($queryFields[$requestedFields[2]]['type'] === 'decimal')
                                <div>{{ format_money($cliente->{$requestedFields[2]}) }}</div>
                            @elseif ($queryFields[$requestedFields[2]]['type'] === 'enum')
                                <div>{{ $queryFields[$requestedFields[2]]['list'][$cliente->{$requestedFields[2]}] }}</div>
                            @endif
                        </td>
                    @else
                        <td class="table-text col-md-2" data-field="codice_fiscale"><div>{{ $cliente->codice_fiscale }}</div></td>
                    @endif
                    
                    
                    @if (isset($requestedFields) && count($requestedFields) >= 2)
                        <td class="table-text col-md-2" data-field="{{ $requestedFields[1] }}">
                            @if ($queryFields[$requestedFields[1]]['type'] === 'string')
                                <div>{{ $cliente->{$requestedFields[1]} }}</div>
                            @elseif ($queryFields[$requestedFields[1]]['type'] === 'date')
                                <div>{{ format_date($cliente->{$requestedFields[1]}) }}</div>
                            @elseif ($queryFields[$requestedFields[1]]['type'] === 'decimal')
                                <div>{{ format_money($cliente->{$requestedFields[1]}) }}</div>
                            @elseif ($queryFields[$requestedFields[1]]['type'] === 'enum')
                                <div>{{ $queryFields[$requestedFields[1]]['list'][$cliente->{$requestedFields[1]}] }}</div>
                            @endif
                        </td>
                    @else
                        <td class="table-text col-md-2" data-field-select="professione" data-field-id="{{ $cliente->professione_id }}">
                            <div>{{ $cliente->professione ? $cliente->professione->nome : '' }}</div>
                        </td>
                    @endif
                    
                    @if (isset($requestedFields) && count($requestedFields) >= 1)
                        <td class="table-text col-md-2" data-field="{{ $requestedFields[0] }}">
                            @if ($queryFields[$requestedFields[0]]['type'] === 'string')
                                <div>{{ $cliente->{$requestedFields[0]} }}</div>
                            @elseif ($queryFields[$requestedFields[0]]['type'] === 'date')
                                <div>{{ format_date($cliente->{$requestedFields[0]}) }}</div>
                            @elseif ($queryFields[$requestedFields[0]]['type'] === 'decimal')
                                <div>{{ format_money($cliente->{$requestedFields[0]}) }}</div>
                            @elseif ($queryFields[$requestedFields[0]]['type'] === 'enum')
                                <div>{{ $queryFields[$requestedFields[0]]['list'][$cliente->{$requestedFields[0]}] }}</div>
                            @endif
                        </td>
                    @else
                        <td class="table-text col-md-2" data-field-select="filiale" data-field-id="{{ $cliente->filiale_id }}">
                            <div>{{ $cliente->filiale ? $cliente->filiale->nome : '' }}</div>
                        </td>
                    @endif
                    
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
@else
    <p class="text-center">Non sono presenti clienti</p>
@endif