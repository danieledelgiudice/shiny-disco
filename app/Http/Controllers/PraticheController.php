<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PraticheController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('conferma-promemoria');
        
        $this->queryFields = [
            'numero_pratica'                 => ['display'   => 'Numero pratica',                      'type'        => 'string',      ],
            'numero_registrazione'           => ['display'   => 'Numero registrazione',                'type'        => 'string',      ],
            'data_apertura'                  => ['display'   => 'Data apertura',                       'type'        => 'date',        ],
            'stato_pratica'                  => ['display'   => 'Stato pratica',                       'type'        => 'enum',        'list' => \App\Pratica::$enumStatoPratica],
            'tipo_pratica'                   => ['display'   => 'Tipo pratica',                        'type'        => 'enum',        'list' => \App\Pratica::$enumTipoPratica],
            
            'veicolo_parte'                  => ['display'   => 'Veicolo di parte',                    'type'        => 'string',      ],
            'targa_parte'                    => ['display'   => 'Targa di parte',                      'type'        => 'string',      ],
            'numero_polizza_parte'           => ['display'   => 'Numero polizza di parte',             'type'        => 'string',      ],
            'assicurazione_parte'            => ['display'   => 'Assicurazione parte',                 'type'        => 'string',      ],
            
            'conducente_controparte'         => ['display'   => 'Conducente controparte',              'type'        => 'string',      ],
            'via_controparte'                => ['display'   => 'Via controparte',                     'type'        => 'string',      ],
            'citta_controparte'              => ['display'   => 'Città controparte',                   'type'        => 'string',      ],
            'telefono_controparte'           => ['display'   => 'Telefono controparte',                'type'        => 'string',      ],
            'veicolo_controparte'            => ['display'   => 'Veicolo controparte',                 'type'        => 'string',      ],
            'targa_controparte'              => ['display'   => 'Targa controparte',                   'type'        => 'string',      ],
            'numero_polizza_controparte'     => ['display'   => 'Numero polizza controparte',          'type'        => 'string',      ],
            'proprietario_mezzo_responsabile'=> ['display'   => 'Proprietario mezzo responsabile',     'type'        => 'string',      ],
            'assicurazione_controparte'      => ['display'   => 'Assicurazione controparte',           'type'        => 'string',      ],
            'medico_controparte'             => ['display'   => 'Medico controparte',                  'type'        => 'string',      ],
            'parcella_presunta'              => ['display'   => 'Parcella presunta',                   'type'        => 'decimal',     ],
            
            'legale'                         => ['display'   => 'Legale',                              'type'        => 'string',      ],
            'in_data'                        => ['display'   => 'In data',                             'type'        => 'date',        ],
            'controllato'                    => ['display'   => 'Controllato',                         'type'        => 'enum',        'list' => \App\Pratica::$enumControllato],
            'data_ultima_lettera'            => ['display'   => 'Data ultima lettera',                 'type'        => 'date',        ],
            'mezzo_liquidato'                => ['display'   => 'Mezzo liquidato',                     'type'        => 'date',        ],
            'valore_mezzo_liquidato'         => ['display'   => 'Valore mezzo liquidato',              'type'        => 'decimal',     ],
            'rilievi'                        => ['display'   => 'Rilievi',                             'type'        => 'enum',        'list' => \App\Pratica::$enumRilievi],
            'data_chiusura'                  => ['display'   => 'Data chiusura',                       'type'        => 'date',        ],
            'data_sospeso'                   => ['display'   => 'Data sospeso',                        'type'        => 'date',        ], 
            'importo_sospeso'                => ['display'   => 'Importo sospeso',                     'type'        => 'decimal',     ],
            'onorari'                        => ['display'   => 'Onorari',                             'type'        => 'decimal',     ],
            'liquidato_omnia'                => ['display'   => 'Liquidato omnia',                     'type'        => 'decimal',     ],
            
            'data_sinistro'                  => ['display'   => 'Data sinistro',                       'type'        => 'date',        ],
            'luogo_sinistro'                 => ['display'   => 'Luogo sinistro',                      'type'        => 'string',      ],
            'testimoni'                      => ['display'   => 'Testimoni',                           'type'        => 'string',      ],
            'autorita_id'                    => ['display'   => 'Autorità',                            'type'        => 'enum',        'list' => \App\Autorita::pluck('nome', 'id')],   
            'comando_autorita'               => ['display'   => 'Comando autorità',                    'type'        => 'string',      ],
            'rivalsa'                        => ['display'   => 'Rivalsa',                             'type'        => 'enum',        'list' => \App\Pratica::$enumRivalsa],
            'soccorso'                       => ['display'   => 'Soccorso',                            'type'        => 'enum',        'list' => \App\Pratica::$enumSoccorso],
            'tipologia_intervento'           => ['display'   => 'Tipologia intervento',                'type'        => 'string',      ],
            'assicurazione_responsabile'     => ['display'   => 'Assicurazione responsabile',          'type'        => 'string',      ],
            'assicurazione_risarcente'       => ['display'   => 'Assicurazione risarcente',            'type'        => 'string',      ],
            'numero_sinistro'                => ['display'   => 'Numero sinistro',                     'type'        => 'string',      ],
            'data_prossima_udienza'          => ['display'   => 'Data prossima udienza',               'type'        => 'date',        ],
            'data_prescrizione'              => ['display'   => 'Data prescrizione',                   'type'        => 'date',        ],
            
            //////////////////////////////////////////
            
            'cliente-cognome'                      => ['display' => 'Cognome (Cliente)',                     'type'      => 'string',     ],
            'cliente-nome'                         => ['display' => 'Nome (Cliente)',                        'type'      => 'string',     ],
            'cliente-citta_nascita'                => ['display' => 'Città di nascita (Cliente)',            'type'      => 'string',     ],
            'cliente-data_nascita'                 => ['display' => 'Data di nascita (Cliente)',             'type'      => 'date',       ],
            'cliente-sesso'                        => ['display' => 'Sesso (Cliente)',                       'type'      => 'enum',           'list' => \App\Cliente::$enumSesso ],
            'cliente-codice_fiscale'               => ['display' => 'Codice Fiscale (Cliente)',              'type'      => 'string',     ],
            
            'cliente-via'                          => ['display' => 'Via (Cliente)',                         'type'      => 'string',     ],
            'cliente-citta_residenza'              => ['display' => 'Città di residenza (Cliente)',          'type'      => 'string',     ],
            'cliente-provincia'                    => ['display' => 'Provincia (Cliente)',                   'type'      => 'string',     ],
            'cliente-cap'                          => ['display' => 'CAP (Cliente)',                         'type'      => 'string',     ],

            'cliente-partita_iva'                  => ['display' => 'P. IVA (Cliente)',                      'type'      => 'string',     ],
            'cliente-stato_civile'                 => ['display' => 'Stato civile (Cliente)',                'type'      => 'enum',           'list' => \App\Cliente::$enumStatoCivile ],
            'cliente-tipo_documento'               => ['display' => 'Tipo documento (Cliente)',              'type'      => 'enum',           'list' => \App\Cliente::$enumTipoDocumento ],
            'cliente-numero_documento'             => ['display' => 'Numero documento (Cliente)',            'type'      => 'string',     ],
            'cliente-professione_id'               => ['display' => 'Professione (Cliente)',                 'type'      => 'enum',           'list' => \App\Professione::pluck('nome', 'id')],
            'cliente-dettagli_professione'         => ['display' => 'Dettagli professione (Cliente)',        'type'      => 'string',     ],
            'cliente-reddito'                      => ['display' => 'Reddito (Cliente)',                     'type'      => 'decimal',    ],
            'cliente-numero_card'                  => ['display' => 'Numero Card (Cliente)',                 'type'      => 'string',     ],
            
            'cliente-filiale_id'                   => ['display' => 'Filiale (Cliente)',                     'type'      => 'enum',           'list' => \App\Filiale::pluck('nome', 'id')],
            'cliente-importante'                   => ['display' => 'Importante (Cliente)',                  'type'      => 'enum',           'list' => [0 => 'No', 1 => 'Sì']],
            
        ];
    }
    
    public function index(Request $request)
    {
        $queryFields = $this->queryFields;
        
        return view('pratiche.index', compact('queryFields'));
    }
    
    public function show(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if ($request->user()->cannot('visualizzare-pratica', $pratica)) {
            // L'utente non ha il permesso di vedere questa pratica
            abort(403);
        }
        
        $documenti = $pratica->documenti()->get();
        $assegni = $pratica->assegni()->oldest('data')->get();
        $promemoria = $pratica->promemoria()->oldest('quando')->get();
        $totale_assegni_consegnati = $pratica->assegni()->where('tipologia', 0)->sum('importo');
        $totale_assegni_restituiti = $pratica->assegni()->where('tipologia', 1)->sum('importo');
        
        $prestazioni_mediche_c = $pratica->prestazioni_mediche()->inConvenzione()->get()->groupBy('nome_medico');
        $prestazioni_mediche_nc = $pratica->prestazioni_mediche()->nonConvenzione()->get();
        
        return view('pratiche.show', compact('pratica', 'documenti', 'assegni', 'promemoria', 'totale_assegni_consegnati',
                                                'totale_assegni_restituiti', 'prestazioni_mediche_nc', 'prestazioni_mediche_c'));
    }

    public function edit(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if ($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non ha il permesso di vedere questa pratica
            abort(403);
        }
        
        $autorita = \App\Autorita::pluck('nome', 'id');
        $filiale = $pratica->cliente->filiale;
        
        return view('pratiche.edit', compact('pratica', 'filiale', 'autorita'));
    }

    public function update(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if ($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non ha il permesso di vedere questa pratica
            abort(403);
        }

        $this->validateInput($request);
        
        $pratiche_stesso_numero = \App\Pratica::whereHas('cliente', function($query) use ($pratica) {
                $query->where('filiale_id', $pratica->cliente->filiale->id);
            })->where('numero_pratica', $request->numero_pratica)->get();

        if (count($pratiche_stesso_numero) > 0 && $pratiche_stesso_numero[0]->id != $pratica->id) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Numero pratica già esistente per questa filiale.']);
        }
        
        $pratiche_stessa_registrazione = \App\Pratica::whereHas('cliente', function($query) use ($pratica) {
                $query->where('filiale_id', $pratica->cliente->filiale->id);
            })->where('numero_registrazione', $request->numero_registrazione)->get();

        if (count($pratiche_stessa_registrazione) > 0 && $pratiche_stessa_registrazione[0]->id != $pratica->id) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Numero registrazione già esistente per questa filiale.']);
        }
        
        if (($request->onorari + 0) && ($request->parcella_presunta + 0)) {
            return redirect()->back()->withInput()->withErrors(['message' => 'I campi onorari e parcella presunta sono esclusivi.']);
        }

        $new_values = $request->all();
        
        $pratica->fill($new_values);
        
        $autorita = \App\Autorita::find($request->autorita_id);
        if ($autorita === null)
        {
            // Se l'autorità non esiste la creo
            $autorita = \App\Autorita::create(['nome' => $request->autorita_id]);
        }
        
        $pratica->autorita()->associate($autorita);
        
        $pratica->save();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica])
                    ->with('success', 'Pratica modificata con successo!');
    }
    
    public function create(Request $request, $id)
    {
        $cliente = \App\Cliente::findOrFail($id);
        
        if ($request->user()->cannot('creare-pratica', $cliente)) {
            // L'utente non ha il permesso di aggiungere pratiche a clienti di altre filiali
            abort(403);
        }
        
        // Creo pratica  per popolare la form di creazione con valori default
        $pratica = new \App\Pratica;
        $pratiche_filiale = \App\Pratica::whereHas('cliente', function($query) use ($cliente) {
                $query->where('filiale_id', $cliente->filiale->id);
            })->get();
        $pratica->fill([
            'numero_pratica'                => $pratiche_filiale->max('numero_pratica') + 1,
            'numero_registrazione'          => $pratiche_filiale->max('numero_registrazione') + 1,
            'data_apertura'                 => \Carbon\Carbon::today(),
        ]);
          
        $filiale = $cliente->filiale;
        $autorita = \App\Autorita::pluck('nome', 'id');
        
        return view('pratiche.create', compact('cliente', 'pratica', 'filiale', 'autorita'));
    }
    
    public function store(Request $request, $cliente_id)
    {
        $cliente = \App\Cliente::findOrFail($cliente_id);
        
        if ($request->user()->cannot('creare-pratica', $cliente)) {
            // L'utente non ha il permesso di aggiungere pratiche a clienti di altre filiali
            abort(403);
        }
        
        $this->validateInput($request);

        $pratiche_stesso_numero = \App\Pratica::whereHas('cliente', function($query) use ($cliente) {
                $query->where('filiale_id', $cliente->filiale->id);
            })->where('numero_pratica', $request->numero_pratica)->get();

        if (count($pratiche_stesso_numero) > 0) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Numero pratica già esistente per questa filiale.']);
        }
        
        $pratiche_stessa_registrazione = \App\Pratica::whereHas('cliente', function($query) use ($cliente) {
                $query->where('filiale_id', $cliente->filiale->id);
            })->where('numero_registrazione', $request->numero_registrazione)->get();

        if (count($pratiche_stessa_registrazione) > 0) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Numero registrazione già esistente per questa filiale.']);
        }
        
        if ($request->crea_copia) {
            $pratiche_stesso_numero = \App\Pratica::whereHas('cliente', function($query) use ($cliente) {
                    $query->where('filiale_id', $cliente->filiale->id);
                })->where('numero_pratica', $request->numero_pratica + 1)->get();
    
            if (count($pratiche_stesso_numero) > 0) {
                return redirect()->back()->withInput()->withErrors(['message' => 'Numero pratica (per la copia) già esistente per questa filiale.']);
            }
            
            $pratiche_stessa_registrazione = \App\Pratica::whereHas('cliente', function($query) use ($cliente) {
                    $query->where('filiale_id', $cliente->filiale->id);
                })->where('numero_registrazione', $request->numero_registrazione + 1)->get();
    
            if (count($pratiche_stessa_registrazione) > 0) {
                return redirect()->back()->withInput()->withErrors(['message' => 'Numero registrazione (per la copia) già esistente per questa filiale.']);
            }
        }
        
        if (($request->onorari + 0) && ($request->parcella_presunta + 0)) {
            return redirect()->back()->withInput()->withErrors(['message' => 'I campi onorari e parcella presunta sono esclusivi.']);
        }
        
        $pratica = new \App\Pratica;
        $new_values = $request->all();
        
        $pratica->fill($new_values);
        
        $autorita = \App\Autorita::find($request->autorita_id);
        if ($autorita === null && trim($request->autorita_id) != '')
        {
            // Se l'autorità non esiste la creo
            $autorita = \App\Autorita::create(['nome' => $request->autorita_id]);
        }
        
        if ($autorita !== null)
            $pratica->autorita()->associate($autorita);
        
        $pratica->cliente()->associate($cliente);
        $pratica->save();
        
        if ($request->crea_copia) {
            $pratica = new \App\Pratica;

            $pratica->fill($new_values);
            $pratica->numero_pratica = $request->numero_pratica + 1;
            $pratica->numero_registrazione = $request->numero_registrazione + 1;
            
            $autorita = \App\Autorita::find($request->autorita_id);

            if ($autorita === null && trim($request->autorita_id) != '')
            {
                // Se l'autorità non esiste la creo
                $autorita = \App\Autorita::create(['nome' => $request->autorita_id]);
            }
            
            if ($autorita !== null)
                $pratica->autorita()->associate($autorita);
            
            $pratica->cliente()->associate($cliente);
            $pratica->save();
        }

        // TODO: mostrare messaggio nella view
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica])
                    ->with('success', 'Pratica salvata con successo!');
    }
    
    public function destroy(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if ($request->user()->cannot('eliminare-pratica', $pratica)) {
            // L'utente sta cercando di eliminare una pratica che non gli appartiene
            abort(403);
        }
        
        $pratica->delete();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('ClientiController@show', ['cliente' => $pratica->cliente])
                    ->with('success', 'Pratica eliminata con successo!');
    }
    
    public function filter(Request $request)
    {
        $params = [];
        $requestedFields = ['numero_pratica'];
        $j = 6;
        
        foreach($request->all() as $k => $v)
        {
            if ($k[0] != '_') {
                if ($v != '')
                    $params[$k] = $v;
                if ($j > 1 && !in_array($k, $requestedFields))
                    $requestedFields[--$j] = $k;
            }
        }
        
        $replacements = ['stato_pratica', 'tipo_pratica', 'data_apertura', '', '', ''];
        $i = 1;
        while ($i < $j && !empty($replacements))
        {
            $rep = array_shift($replacements);
            if (!in_array($rep, $requestedFields) || $rep === '') {
                $requestedFields[$i] = $rep;
                $i++;
            }
        }
        

        if ($request->user()->isAdmin())
            $pratiche = \App\Pratica::filter($params)->get();
        else
            $pratiche = \App\Pratica::whereHas('cliente', function($query) use ($request) {
                $query->where('filiale_id', $request->user()->filiale->id);
            })->filter($params)->get();
                                     
        
        $queryFields = $this->queryFields;
        
        return view('pratiche._tabella', compact('pratiche', 'requestedFields', 'queryFields'));
    }
    
    private function validateInput(Request $request)
    {
        $this->validate($request, [
            'numero_pratica'                    => "required|numeric",
            'numero_registrazione'              => "required|numeric",
            'stato_pratica'                     => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumStatoPratica)),
            'tipo_pratica'                      => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumTipoPratica)),
            'data_apertura'                     => 'date_format:d/m/Y|before:tomorrow',
            
            'veicolo_parte'                     => 'max:255',
            'targa_parte'                       => 'max:255',
            'numero_polizza_parte'              => 'max:255',
            'assicurazione_parte'               => 'max:255',
            
            'conducente_controparte'            => 'max:255',
            'via_controparte'                   => 'max:255',
            'citta_controparte'                 => 'max:255',
            'telefono_controparte'              => 'max:255',
            'veicolo_controparte'               => 'max:255',
            'targa_controparte'                 => 'max:255',
            'numero_polizza_controparte'        => 'max:255',
            'proprietario_mezzo_responsabile'   => 'max:255',
            'assicurazione_controparte'         => 'max:255',
            'medico_controparte'                => 'max:255',
            'luogo_medico_controparte'          => 'max:255',
            'data_medico_controparte'           => 'max:255',
            'liquidatore'                       => 'max:255',
            'reperibilita_liquidatore'          => 'max:255',
            'parcella_presunta'                 => 'numeric|max:100000000|min:0',
                
            'legale'                            => 'max:255',                                             
            'in_data'                           => 'date_format:d/m/Y',
            'controllato'                       => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumControllato)),
            'data_ultima_lettera'               => 'date_format:d/m/Y|before:tomorrow',
            'mezzo_liquidato'                   => 'date_format:d/m/Y',
            'valore_mezzo_liquidato'            => 'numeric|max:100000000|min:0',
            'rilievi'                           => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumRilievi)),
            'data_chiusura'                     => 'date_format:d/m/Y',
            'importo_sospeso'                   => 'numeric|max:100000000|min:0',
            'data_sospeso'                      => 'date_format:d/m/Y',
            'onorari'                           => 'numeric|max:100000000|min:0',
            'liquidato_omnia'                   => 'numeric|max:100000000|min:0',
            
            'data_sinistro'                     => 'date_format:d/m/Y|before:tomorrow',
            'ora_sinistro'                      => 'max:255',   //potrebbero voler scrivere "Intorno alle 22" o simili
            'luogo_sinistro'                    => 'max:255',
            'comando_autorita'                  => 'max:255',
            'testimoni'                         => 'max:255',
            'rivalsa'                           => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumRivalsa)),
            'soccorso'                          => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumSoccorso)),
            'tipologia_intervento'              => 'max:255',
            'danno_presunto'                    => 'numeric|max:100000000|min:0',
            
            'assicurazione_risarcente'          => 'max:255',
            'assicurazione_responsabile'        => 'max:255',
            'numero_sinistro'                   => 'max:255',
            'data_prossima_udienza'             => 'date_format:d/m/Y',
            'data_prescrizione'                 => 'date_format:d/m/Y',
            
        ]);
    }
    
    private $queryFields = [];
}
