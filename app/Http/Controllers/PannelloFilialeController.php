<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class PannelloFilialeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('conferma-promemoria');
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

    public function liquidatoOmnia(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $pratiche = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->whereIn('stato_pratica', [0, 3])
          ->where('liquidato_omnia', '>', 0)
          ->latest('data_apertura')->get(); //stato pratica: aperte o ss. legale
        
        
        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.liquidato_omnia', compact('filiale', 'filiali', 'pratiche'));
    }
    
    public function importoSospeso(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $pratiche = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->whereIn('stato_pratica', [0, 3])
          ->where('importo_sospeso', '>', 0)
          ->latest('data_apertura')->get(); //stato pratica: aperte o ss. legale
        
        
        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.importo_sospeso', compact('filiale', 'filiali', 'pratiche'));
    }
    
    public function parcellaPresunta(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $pratiche = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->whereIn('stato_pratica', [0, 3])
          ->where('parcella_presunta', '>', 0)
          ->latest('data_apertura')->get(); //stato pratica: aperte o ss. legale
        
        
        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.parcella_presunta', compact('filiale', 'filiali', 'pratiche'));
    }
    
    public function onorari(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $pratiche = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->whereIn('stato_pratica', [0, 3])
          ->where('onorari', '>', 0)
          ->latest('data_apertura')->get(); //stato pratica: aperte o ss. legale
        
        
        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.onorari', compact('filiale', 'filiali', 'pratiche'));
    }
}
