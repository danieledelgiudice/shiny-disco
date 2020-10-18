<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class PagamentiController extends Controller
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
            // L'utente non può aggiungere pagamenti a pratiche di altre filiali
            abort(403);
        }
        
        return view('pagamenti.create', compact('pratica'));
    }
    
    public function store(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non può aggiungere pagamenti a pratiche di altre filiali
            abort(403);
        }
        
        $this->validateInput($request);
        
        $pagamento = new \App\Pagamento();
        $pagamento->fill($request->all());
        
        $pagamento->pratica()->associate($pratica);
        $pagamento->save();
        
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica])
            ->with('success', 'Il pagamento è stato salvato con successo.');
    }
    
    public function edit(Request $request, $cliente_id, $pratica_id, $pagamento_id)
    {
        $pagamento = \App\Pagamento::findOrFail($pagamento_id);
        
        if ($pagamento->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica del pagamento
            abort(404);
        }
        
        if ($pagamento->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $pagamento->pratica)) {
            // L'utente non può aggiungere pagamenti a pratiche di altre filiali
            abort(403);
        }
        
        return view('pagamenti.edit', compact('pagamento'));
    }
    
    public function update(Request $request, $cliente_id, $pratica_id, $pagamento_id)
    {
        $pagamento = \App\Pagamento::findOrFail($pagamento_id);
        
        if ($pagamento->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica del pagamento
            abort(404);
        }
        
        if ($pagamento->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $pagamento->pratica)) {
            // L'utente non può modificare pagamenti di pratiche di altre filiali
            abort(403);
        }
        
        $this->validateInput($request);
        
        $pagamento->fill($request->all());
        $pagamento->save();
        
        return redirect()->action('PraticheController@show', ['cliente' => $pagamento->pratica->cliente, 'pratica' => $pagamento->pratica])
            ->with('success', 'Il pagamento è stato modificato con successo.');
    }
    
    public function destroy(Request $request, $cliente_id, $pratica_id, $pagamento_id)
    {
        $pagamento = \App\Pagamento::findOrFail($pagamento_id);
        
        if ($pagamento->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica del pagamento
            abort(404);
        }
        
        if ($pagamento->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $pagamento->pratica)) {
            // L'utente non può modificare pagamenti di pratiche di altre filiali
            abort(403);
        }
        
        $pagamento->delete();
                
        return redirect()->action('PraticheController@show', ['cliente' => $pagamento->pratica->cliente, 'pratica' => $pagamento->pratica])
            ->with('success', 'Il pagamento è stato eliminato con successo.');
    }
    
    private function validateInput(Request $request)
    {
        $this->validate($request, [
            'data'              => 'required|date_format:d/m/Y',
            'importo'           => 'required|numeric|max:100000000|min:0',
            'cose'              => 'boolean|required_without_all:persone,spese_mediche',
            'persone'           => 'boolean|required_without_all:cose,spese_mediche',
            'spese_mediche'     => 'boolean|required_without_all:cose,persone'
        ]);
    }
}
