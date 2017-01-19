<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class PannelloFilialeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function home(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $filiali = \App\Filiale::all();
        return view('pannello_filiale.home', compact('filiale', 'filiali'));
    }
    
    public function compagnieAssicurative(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $compagnie_assicurative = $filiale->compagnieAssicurative;
        $filiali = \App\Filiale::all();

        return view('pannello_filiale.compagnie_assicurative', compact('filiale', 'filiali', 'compagnie_assicurative'));
    }
    
    public function totaliOmnia(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $pratiche_query = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        });
        
        $somma_onorari = $pratiche_query->sum('onorari_omnia');
        $somma_liquidato = $pratiche_query->sum('liquidato_omnia');
        
        $filiali = \App\Filiale::all();
        return view('pannello_filiale.totali_omnia', compact('filiale', 'filiali', 'somma_onorari', 'somma_liquidato'));
    }
}
