<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class CompagnieAssicurativeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(Request $request, $filiale_id, $compagnia_assicurativa_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        $compagnia_assicurativa = \App\CompagniaAssicurativa::findOrFail($compagnia_assicurativa_id);
        
        if($compagnia_assicurativa->filiale != $filiale) {
            // La filiale della compagnia non corrisponde alla filiale fornita
            abort(404);
        }
        
        if($request->user()->cannot('modificare-compagnia-assicurativa', $compagnia_assicurativa)) {
            // L'utente non ha il permesso di eliminare la compagnia fornita
            abort(403);
        }
        
        return view('compagnie_assicurative.edit', compact('compagnia_assicurativa'));
    }
    
    public function destroy(Request $request, $filiale_id, $compagnia_assicurativa_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        $compagnia_assicurativa = \App\CompagniaAssicurativa::findOrFail($compagnia_assicurativa_id);
        
        if($compagnia_assicurativa->filiale != $filiale) {
            // La filiale della compagnia non corrisponde alla filiale fornita
            abort(404);
        }
        
        if($request->user()->cannot('eliminare-compagnia-assicurativa', $compagnia_assicurativa)) {
            // L'utente non ha il permesso di eliminare la compagnia fornita
            abort(403);
        }
        
        $compagnia_assicurativa->delete();
        
        return redirect()->back();
    }
    
    public function update(Request $request, $filiale_id, $compagnia_assicurativa_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        $compagnia_assicurativa = \App\CompagniaAssicurativa::findOrFail($compagnia_assicurativa_id);
        
        if($compagnia_assicurativa->filiale != $filiale) {
            // La filiale della compagnia non corrisponde alla filiale fornita
            abort(404);
        }
        
        if($request->user()->cannot('modificare-compagnia-assicurativa', $compagnia_assicurativa)) {
            // L'utente non ha il permesso di eliminare la compagnia fornita
            abort(403);
        }
        
        $this->validateInput($request);
        
        $compagnia_assicurativa->fill($request->all());
        $compagnia_assicurativa->save();
        
        return redirect()->action('PannelloFilialeController@compagnieAssicurative',
            ['filiale' => $compagnia_assicurativa->filiale]);
    }
    
    public function create(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);

        if($request->user()->cannot('creare-compagnia-assicurativa', $filiale)) {
            // L'utente non ha il permesso di creare una compagnia per la filiale
            abort(403);
        }
        
        return view('compagnie_assicurative.create', compact('filiale'));
    }
    
    public function store(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);

        if($request->user()->cannot('creare-compagnia-assicurativa', $filiale)) {
            // L'utente non ha il permesso di creare una compagnia per la filiale
            abort(403);
        }
        
        $this->validateInput($request);
        
        $compagnia_assicurativa = new \App\CompagniaAssicurativa;
        $compagnia_assicurativa->fill($request->all());
        
        $compagnia_assicurativa->filiale()->associate($filiale);
        
        $compagnia_assicurativa->save();
        
        return redirect()->action('PannelloFilialeController@compagnieAssicurative', ['filiale' => $compagnia_assicurativa->filiale]);
    }
    
    private function validateInput(Request $request)
    {
        $this->validate($request, [
            'nome'      => 'required|max:255',
            'indirizzo' => 'max:255',
            'telefono'  => 'max:255',
            'fax'       => 'max:255',
            'email'     => 'max:255|email',
            'giorni'    => 'max:255',
        ]);
    }
}

