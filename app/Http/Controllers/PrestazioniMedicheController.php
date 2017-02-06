<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class PrestazioniMedicheController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('conferma-promemoria');
    }
    
    public function create(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non può aggiungere prestazioni a pratiche di altre filiali
            abort(403);
        }
        
        $prestazione_medica = new \App\PrestazioneMedica;
        $prestazione_medica->percentuale = 0;
        
        return view('prestazioni_mediche.create', compact('pratica', 'prestazione_medica'));
    }
    
    public function store(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non può aggiungere prestazioni a pratiche di altre filiali
            abort(403);
        }
        
        $percentuale = $request->percentuale;
        
        if($request->inConvenzione == '1') {
            $this->validate($request, [ 'percentuale' => 'required|numeric|min:1|max:100' ]);
        } else
            $percentuale = 0;
            
        $this->validateInput($request);
        
        $prestazione_medica = new \App\PrestazioneMedica;
        $prestazione_medica->fill($request->all());
        
        if ($request->pagato) {
            $prestazione_medica->pagato = true;
        } else {
            $prestazione_medica->pagato = false;
        }
        
        $prestazione_medica->pratica()->associate($pratica);
        $prestazione_medica->percentuale = $percentuale;
        $prestazione_medica->save();
        
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica])
            ->with('success', 'La prestazione medica è stata salvata con successo.');
        
    }
    
    public function edit(Request $request, $cliente_id, $pratica_id, $prestazione_medica_id)
    {
        $prestazione_medica = \App\PrestazioneMedica::findOrFail($prestazione_medica_id);
        
        if ($prestazione_medica->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica della prestazione
            abort(404);
        }
        
        if ($prestazione_medica->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $prestazione_medica->pratica)) {
            // L'utente non può aggiungere prestazioni a pratiche di altre filiali
            abort(403);
        }
        
        return view('prestazioni_mediche.edit', compact('prestazione_medica'));
    }
    
    public function update(Request $request, $cliente_id, $pratica_id, $prestazione_medica_id)
    {
        $prestazione_medica = \App\PrestazioneMedica::findOrFail($prestazione_medica_id);
        
        if ($prestazione_medica->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica della prestazione
            abort(404);
        }
        
        if ($prestazione_medica->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $prestazione_medica->pratica)) {
            // L'utente non può modificare prestazioni di pratiche di altre filiali
            abort(403);
        }
        
        $percentuale = $request->percentuale;
        
        if ($request->inConvenzione == '1') {
            $this->validate($request, [ 'percentuale' => 'required|numeric|min:1|max:100' ]);
        } else
            $percentuale = 0;
            
        if ($request->pagato) {
            $prestazione_medica->pagato = true;
        } else {
            $prestazione_medica->pagato = false;
        }
            
        $this->validateInput($request);
        
        $prestazione_medica->fill($request->all());
        $prestazione_medica->percentuale = $percentuale;
        $prestazione_medica->save();
        
        return redirect()->action('PraticheController@show', ['cliente' => $prestazione_medica->pratica->cliente, 'pratica' => $prestazione_medica->pratica])
            ->with('success', 'La prestazione medica è stata modificata con successo.');
    }
    
    public function destroy(Request $request, $cliente_id, $pratica_id, $prestazione_medica_id)
    {
        $prestazione_medica = \App\PrestazioneMedica::findOrFail($prestazione_medica_id);
        
        if ($prestazione_medica->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica della prestazione
            abort(404);
        }
        
        if ($prestazione_medica->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $prestazione_medica->pratica)) {
            // L'utente non può modificare prestazioni di pratiche di altre filiali
            abort(403);
        }
        
        $prestazione_medica->delete();
                
        return redirect()->action('PraticheController@show', ['cliente' => $prestazione_medica->pratica->cliente, 'pratica' => $prestazione_medica->pratica])
            ->with('success', 'La prestazione medica è stata eliminata con successo.');
    }
    
    private function validateInput(Request $request)
    {
        $this->validate($request, [
            'nome_medico'       => 'required|max:255',
            'data'              => 'required|date_format:d/m/Y',
            'giorni'            => 'required|numeric|max:100000000|min:0',
            'costo'             => 'required|numeric|max:100000000|min:0',
        ]);
    }
}
