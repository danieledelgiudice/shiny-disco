@if (count($clienti) > 0)
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
                            <div>{{ $cliente->{$requestedFields[2]} }}</div>
                        </td>
                    @else
                        <td class="table-text col-md-2" data-field="codice_fiscale"><div>{{ $cliente->codice_fiscale }}</div></td>
                    @endif
                    
                    
                    @if (isset($requestedFields) && count($requestedFields) >= 2)
                        <td class="table-text col-md-2" data-field="{{ $requestedFields[1] }}">
                            <div>{{ $cliente->{$requestedFields[1]} }}</div>
                        </td>
                    @else
                        <td class="table-text col-md-2" data-field-select="professione" data-field-id="{{ $cliente->professione_id }}">
                            <div>{{ $cliente->professione ? $cliente->professione->nome : '' }}</div>
                        </td>
                    @endif
                    
                    @if (isset($requestedFields) && count($requestedFields) >= 1)
                        <td class="table-text col-md-2" data-field="{{ $requestedFields[0] }}">
                            <div>{{ $cliente->{$requestedFields[0]} }}</div>
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