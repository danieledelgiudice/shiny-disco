<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ClientiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('conferma-promemoria');
        
        $this->queryFields = [
            'cognome'                      => ['display' => 'Cognome',                     'type'      => 'string',     ],
            'nome'                         => ['display' => 'Nome',                        'type'      => 'string',     ],
            'citta_nascita'                => ['display' => 'Città di nascita',            'type'      => 'string',     ],
            'data_nascita'                 => ['display' => 'Data di nascita',             'type'      => 'date',       ],
            'sesso'                        => ['display' => 'Sesso',                       'type'      => 'enum',           'list' => \App\Cliente::$enumSesso ],
            'codice_fiscale'               => ['display' => 'Codice Fiscale',              'type'      => 'string',     ],
            
            'via'                          => ['display' => 'Via',                         'type'      => 'string',     ],
            'citta_residenza'              => ['display' => 'Città di residenza',          'type'      => 'string',     ],
            'provincia'                    => ['display' => 'Provincia',                   'type'      => 'string',     ],
            'cap'                          => ['display' => 'CAP',                         'type'      => 'string',     ],
            
            'cellulare'                    => ['display' => 'Cellulare',                   'type'      => 'string',     ],
            'telefono'                     => ['display' => 'Telefono',                    'type'      => 'string',     ],
            'email'                        => ['display' => 'Email',                       'type'      => 'string',     ],
            'fax'                          => ['display' => 'FAX',                         'type'      => 'string',     ],
            
            'partita_iva'                  => ['display' => 'P. IVA',                      'type'      => 'string',     ],
            'stato_civile'                 => ['display' => 'Stato civile',                'type'      => 'enum',           'list' => \App\Cliente::$enumStatoCivile ],
            'tipo_documento'               => ['display' => 'Tipo documento',              'type'      => 'enum',           'list' => \App\Cliente::$enumTipoDocumento ],
            'numero_documento'             => ['display' => 'Numero documento',            'type'      => 'string',     ],
            'professione_id'               => ['display' => 'Professione',                 'type'      => 'enum',           'list' => \App\Professione::pluck('nome', 'id')],
            'dettagli_professione'         => ['display' => 'Dettagli professione',        'type'      => 'string',     ],
            'reddito'                      => ['display' => 'Reddito',                     'type'      => 'decimal',    ],
            'numero_card'                  => ['display' => 'Numero Card',                 'type'      => 'string',     ],
        ];
    }
    
    public function index(Request $request)
    {
        if ($request->user()->isAdmin())
            $clienti = \App\Cliente::filter($request->all())->get();
        else
            $clienti = \App\Cliente::where('filiale_id', $request->user()->filiale->id)
                                     ->filter($request->all())->get();
        
        $filiali = \App\Filiale::pluck('nome', 'id');
        $professioni = \App\Professione::pluck('nome', 'id');

        $queryFields = $this->queryFields;
        
        return view('clienti.index', compact('clienti', 'filiali', 'professioni', 'queryFields'));
    }

    public function show(Request $request, $id)
    {
        $cliente = \App\Cliente::findOrFail($id);
        
        if ($request->user()->cannot('visualizzare-cliente', $cliente)) {
            // L'utente sta cercando di accedere ad un cliente che non gli appartiene
            abort(403);
        }
        
        $pratiche = $cliente->pratiche()->latest('data_apertura')->get();
        
        return view('clienti.show', compact('cliente', 'pratiche'));
    }

    public function edit(Request $request, $id)
    {
        $cliente = \App\Cliente::findOrFail($id);
        
        if ($request->user()->cannot('modificare-cliente', $cliente)) {
            // L'utente sta cercando di accedere ad un cliente che non gli appartiene
            abort(403);
        }
        
        $professioni = \App\Professione::pluck('nome', 'id');
        
        
        return view('clienti.edit', compact('cliente', 'professioni'));
    }

    public function update(Request $request, $id)
    {
        $cliente = \App\Cliente::findOrFail($id);
        
        if ($request->user()->cannot('modificare-cliente', $cliente)) {
            // L'utente sta cercando di accedere ad un cliente che non gli appartiene
            abort(403);
        }
        
        $this->validateInput($request);

        $new_values = $request->all();
        $cliente->fill($new_values);

        if ($request->professione_id) {
            // Se una professione è specificata la cerco
            $professione = \App\Professione::find($request->professione_id);
            if ($professione == null)
            {
                // Se la professione non esiste la creo
                $professione = \App\Professione::create(['nome' => $request->professione_id]);
            }
            
            $cliente->professione()->associate($professione);
        } else {
            // Se non è specificata una professione cancello la relazione
            $cliente->professione()->dissociate();
        }
            
        $cliente->save();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('ClientiController@show', $cliente)->with('success', 'Cliente modificato con successo!');
    }
    
    public function create()
    {
        $professioni = \App\Professione::pluck('nome', 'id');
        return view('clienti.create', compact('professioni'));
    }
    
    public function store(Request $request)
    {
        $this->validateInput($request);
        
        $cliente = new \App\Cliente;
        $new_values = $request->all();
        
        $filiale = $request->user()->filiale;
        
        $cliente->fill($new_values);
        $cliente->filiale()->associate($filiale);
        
        $professione = \App\Professione::find($request->professione_id);
        if ($professione == null)
        {
            // Se la professione non esiste la creo
            $professione = \App\Professione::create(['nome' => $request->professione_id]);
        }
        
        $cliente->professione()->associate($professione);
        
        $cliente->save();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('ClientiController@show', $cliente)->with('success', 'Cliente salvato con successo!');
    }
    
    public function destroy(Request $request, $cliente_id)
    {
        $cliente = \App\Cliente::findOrFail($cliente_id);
        
        if ($request->user()->cannot('eliminare-cliente', $cliente)) {
            // L'utente sta cercando di eliminare un cliente che non gli appartiene
            abort(403);
        }
        
        $cliente->delete();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('ClientiController@index')->with('success', 'Cliente eliminato con successo!');
    }
    
    public function filter(Request $request)
    {
        $params = [];
        $requestedFields = [];
        $fieldCount = 0;
        
        foreach($request->all() as $k => $v)
        {
            if ($k[0] != '_') {
                if ($v != '')
                    $params[$k] = $v;
                if ($k != 'nome' && $k != 'cognome')
                    $requestedFields[$fieldCount++] = $k;
            }
        }

        if ($request->user()->isAdmin())
            $clienti = \App\Cliente::filter($params)->get();
        else
            $clienti = \App\Cliente::where('filiale_id', $request->user()->filiale->id)
                                     ->filter($params)->get();
                                     
        
        $queryFields = $this->queryFields;
    
        return view('clienti._tabella', compact('clienti', 'requestedFields', 'queryFields'));
    }
    
    public function toggleImportante(Request $request, $cliente_id)
    {
        $cliente = \App\Cliente::findOrFail($cliente_id);
        
        if ($request->user()->cannot('modificare-cliente', $cliente)) {
            // L'utente sta cercando di accedere ad un cliente che non gli appartiene
            abort(403);
        }
        
        $old_importante = $cliente->importante;
        $cliente->importante = !$old_importante;
        $cliente->save();
        
        $msg = $cliente->importante ? 'Il cliente è adesso importante' : 'Il cliente non è più importante';
        return redirect()->back()->with('info', $msg);
    }
    
    private function validateInput(Request $request)
    {
        $this->validate($request, [
            'cognome'                   => 'required|max:255',
            'nome'                      => 'required|max:255',
            'citta_nascita'             => 'max:255',
            'data_nascita'              => 'date_format:d/m/Y|before:today',
            'sesso'                     => 'numeric|in:' . implode(',', array_keys(\App\Cliente::$enumSesso)),
            'codice_fiscale'            => 'regex:/^[a-z]{6}[0-9]{2}[a-z][0-9]{2}[a-z][0-9]{3}[a-z]$/i',
            'via'                       => 'max:255',
            'citta_residenza'           => 'max:255',
            'provincia'                 => 'alpha|max:2',
            'cap'                       => 'regex:/^[0-9]{5}$/',
            'cellulare'                 => 'max:255',
            'telefono'                  => 'max:255',
            'email'                     => 'email',
            'fax'                       => 'max:255',
            'partita_iva'               => 'regex:/^[0-9]{11}$/',
            'tipo_documento'            => 'numeric|in:' . implode(',', array_keys(\App\Cliente::$enumTipoDocumento)),
            'numero_documento'          => 'max:255',
            'stato_civile'              => 'numeric|in:' . implode(',', array_keys(\App\Cliente::$enumStatoCivile)),
            'reddito'                   => 'numeric|max:100000000|min:0',
            'numero_card'               => 'max:255'
        ]);
    }
    
    private $queryFields = [];
    
}
