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
    }
    
    public function indexAll(Request $request)
    {
        if ($request->user()->isAdmin())
            $pratiche = \App\Pratica::all();
        else
            $pratiche = \App\Pratica::whereHas('cliente', function($query) use ($request) {
                $query->where('filiale_id', $request->user()->filiale->id);
            })->get();
        
        return view('pratiche.index', compact('pratiche'));
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
        return view('pratiche.show', compact('pratica', 'documenti', 'assegni'));
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
        
        return view('pratiche.edit', compact('pratica'));
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

        $new_values = $request->all();
        
        $pratica->fill($new_values);
        $pratica->save();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica])
                    ->with('success', 'Pratica salvato con successo!');
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
        $pratica->fill([
            'numero_pratica'                => \App\Pratica::max('numero_pratica') + 1,
            'numero_registrazione'          => \App\Pratica::max('numero_registrazione') + 1,
            'data_apertura'                 => \Carbon\Carbon::today(),
        ]);
        return view('pratiche.create', compact('cliente', 'pratica'));
    }
    
    public function store(Request $request, $cliente_id)
    {
        $cliente = \App\Cliente::findOrFail($cliente_id);
        
        if ($request->user()->cannot('creare-pratica', $cliente)) {
            // L'utente non ha il permesso di aggiungere pratiche a clienti di altre filiali
            abort(403);
        }
        
        $this->validateInput($request);
        
        $pratica = new \App\Pratica;
        $new_values = $request->all();
        
        $pratica->fill($new_values);
        
        $pratica->cliente()->associate($cliente);
        $pratica->save();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica])
                    ->with('success', 'Pratica salvato con successo!');
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
    
    private function validateInput(Request $request)
    {
        $this->validate($request, [
            'numero_pratica'                    => 'required|numeric',
            'numero_registrazione'              => 'required|numeric',
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
            
            'legale'                            => 'max:255',                                             
            'in_data'                           => 'date_format:d/m/Y',
            'controllato'                       => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumControllato)),
            'data_ultima_lettera'               => 'date_format:d/m/Y|before:tomorrow',
            'mezzo_liquidabile'                 => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumMezzoLiquidabile)),
            'valore_mezzo_liquidabile'          => 'numeric|max:100000000',
            'rilievi'                           => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumRilievi)),
            'data_chiusura'                     => 'date_format:d/m/Y',
            'importo_sospeso'                   => 'numeric|max:100000000',
            'data_sospeso'                      => 'date_format:d/m/Y',
            'stato_avanzamento'                 => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumStatoAvanzamento)),
            
            'data_sinistro'                     => 'date_format:d/m/Y|before:tomorrow',
            'ora_sinistro'                      => 'max:255',   //potrebbero voler scrivere "Intorno alle 22" o simili
            'luogo_sinistro'                    => 'max:255',
            'autorita'                          => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumAutorita)),
            'comando_autorita'                  => 'max:255',
            'testimoni'                         => 'max:255',
            'rivalsa'                           => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumRivalsa)),
            'soccorso'                          => 'numeric|in:' . implode(',', array_keys(\App\Pratica::$enumSoccorso)),
            'tipologia_intervento'              => 'max:255',
            'danno_presunto'                    => 'numeric|max:100000000',
            
            'assicurazione_risarcente'          => 'max:255',
            'assicurazione_responsabile'        => 'max:255',
        ]);
    }
}
