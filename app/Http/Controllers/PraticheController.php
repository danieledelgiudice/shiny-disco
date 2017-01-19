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
        $promemoria = $pratica->promemoria()->oldest('quando')->get();
        $totale_assegni_consegnati = $pratica->assegni()->where('tipologia', 0)->sum('importo');
        $totale_assegni_restituiti = $pratica->assegni()->where('tipologia', 1)->sum('importo');
        
        return view('pratiche.show', compact('pratica', 'documenti', 'assegni', 'promemoria', 'totale_assegni_consegnati',
                                                'totale_assegni_restituiti'));
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
        
        $assicurazioni = \App\CompagniaAssicurativa::where('filiale_id', $pratica->cliente->filiale->id)->get();
        $autorita = \App\Autorita::pluck('nome', 'id');
        $filiale = $pratica->cliente->filiale;
        
        return view('pratiche.edit', compact('pratica', 'assicurazioni', 'filiale', 'autorita'));
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
        $this->validate($request, [
            'numero_pratica'                    => "required|numeric|unique:pratiche,numero_pratica,$pratica->id",
            'numero_registrazione'              => "required|numeric|unique:pratiche,numero_registrazione,$pratica->id",
        ]);

        $new_values = $request->all();
        
        $pratica->fill($new_values);
        
        if ($request->assicurazione_parte_id) {
            // Se una assicurazione parte è specificata la cerco
            $assicurazione = \App\CompagniaAssicurativa::findOrFail($request->assicurazione_parte_id);
            $pratica->assicurazione_parte()->associate($assicurazione);
        } else {
            // Se non è specificata una assicurazione parte cancello la relazione
            $pratica->assicurazione_parte()->dissociate();
        }
        
        if ($request->assicurazione_controparte_id) {
            // Se una assicurazione controparte è specificata la cerco
            $assicurazione = \App\CompagniaAssicurativa::findOrFail($request->assicurazione_controparte_id);
            $pratica->assicurazione_controparte()->associate($assicurazione);
        } else {
            // Se non è specificata una assicurazione controparte cancello la relazione
            $pratica->assicurazione_controparte()->dissociate();
        }
        
        $autorita = \App\Autorita::find($request->autorita_id);
        if ($autorita == null)
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
        $pratica->fill([
            'numero_pratica'                => \App\Pratica::max('numero_pratica') + 1,
            'numero_registrazione'          => \App\Pratica::max('numero_registrazione') + 1,
            'data_apertura'                 => \Carbon\Carbon::today(),
        ]);
        
        $assicurazioni = \App\CompagniaAssicurativa::where('filiale_id', $cliente->filiale->id)->get();
        
        $filiale = $cliente->filiale;
        
        return view('pratiche.create', compact('cliente', 'pratica', 'assicurazioni', 'filiale'));
    }
    
    public function store(Request $request, $cliente_id)
    {
        $cliente = \App\Cliente::findOrFail($cliente_id);
        
        if ($request->user()->cannot('creare-pratica', $cliente)) {
            // L'utente non ha il permesso di aggiungere pratiche a clienti di altre filiali
            abort(403);
        }
        
        $this->validateInput($request);
        $this->validate($request, [
            'numero_pratica'                    => 'required|numeric|unique:pratiche,numero_pratica',
            'numero_registrazione'              => 'required|numeric|unique:pratiche,numero_registrazione',
        ]);
        
        $pratica = new \App\Pratica;
        $new_values = $request->all();
        
        $pratica->fill($new_values);
        
        if ($request->assicurazione_parte_id) {
            // Se una assicurazione parte è specificata la cerco
            $assicurazione = \App\CompagniaAssicurativa::findOrFail($request->assicurazione_parte_id);
            $pratica->assicurazione_parte()->associate($assicurazione);
        } else {
            // Se non è specificata una assicurazione parte cancello la relazione
            $pratica->assicurazione_parte()->dissociate();
        }
        
        if ($request->assicurazione_controparte_id) {
            // Se una assicurazione controparte è specificata la cerco
            $assicurazione = \App\CompagniaAssicurativa::findOrFail($request->assicurazione_controparte_id);
            $pratica->assicurazione_controparte()->associate($assicurazione);
        } else {
            // Se non è specificata una assicurazione controparte cancello la relazione
            $pratica->assicurazione_controparte()->dissociate();
        }
        
        $autorita = \App\Autorita::find($request->autorita_id);
        if ($autorita == null)
        {
            // Se l'autorità non esiste la creo
            $autorita = \App\Autorita::create(['nome' => $request->autorita_id]);
        }
        
        $pratica->autorita()->associate($autorita);
        
        $pratica->cliente()->associate($cliente);
        $pratica->save();
        
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
    
    private function validateInput(Request $request)
    {
        $this->validate($request, [
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
            'onorari_omnia'                     => 'numeric|max:100000000|min:0',
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
        ]);
    }
}
