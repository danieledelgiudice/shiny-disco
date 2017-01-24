@if (count($clienti) > 0)
    <table class="table table-hover table-striped table-filterable">
        <thead>
            <th>Cognome</th>
            <th>Nome</th>
            <th>Codice Fiscale</th>
            <th>Professione</th>
            <th>Filiale</th>
        </thead>
        <tbody>
            @foreach ($clienti as $cliente)
                <tr>
                    <td class="table-text col-md-2" data-field="cognome"><div>{{ $cliente->cognome }}</div></td>
                    <td class="table-text col-md-2" data-field="nome"><div>{{ $cliente->nome }}</div></td>
                    <td class="table-text col-md-2" data-field="codice_fiscale"><div>{{ $cliente->codice_fiscale }}</div></td>
                    <td class="table-text col-md-2" data-field-select="professione" data-field-id="{{ $cliente->professione_id }}">
                        <div>{{ $cliente->professione ? $cliente->professione->nome : '' }}</div>
                    </td>
                    <td class="table-text col-md-2" data-field-select="filiale" data-field-id="{{ $cliente->filiale_id }}">
                        <div>{{ $cliente->filiale ? $cliente->filiale->nome : '' }}</div>
                    </td>

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