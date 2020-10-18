<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CondivisioniController extends Controller
{
    public function show(Request $request, $cliente_id, $pratica_id) {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('condividere-pratica', $pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }

        $filialiSenzaAccesso = \App\Filiale::where('id', '<>', $request->user()->filiale->id)
            ->whereNotIn('id', $pratica->filialiConAccesso()->pluck('id'))
            ->get();
        
        return view('condivisioni.show', ['pratica' => $pratica, 'filialiSenzaAccesso' => $filialiSenzaAccesso]);
    }

    public function store(Request $request, $cliente_id, $pratica_id) {
        $pratica = \App\Pratica::findOrFail($pratica_id);
     
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('condividere-pratica', $pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }

        $this->validate($request, [
            'filiale' => 'required|exists:filiali,id'
        ]);

        $filiale = \App\Filiale::findOrFail($request->filiale);

        if (!$pratica->filialiConAccesso()->where('filiale_id', $filiale->id)->exists()) {
            $pratica->filialiConAccesso()->attach($filiale);
        }
        
        return redirect()->back()->with('success', "La pratica è stata condivisa con la filiale: {$filiale->nome}.");
    }

    public function destroy(Request $request, $cliente_id, $pratica_id, $filiale_id) {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('condividere-pratica', $pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }

        $pratica->filialiConAccesso()->detach($filiale->id);

        return redirect()->back()->with('success', 'La condivisione è eliminata con successso.');
    }
}
