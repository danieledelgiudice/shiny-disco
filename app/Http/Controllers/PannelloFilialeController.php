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
        
        $pratiche_query = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->whereIn('stato_pratica', [0, 3])
          ->where('liquidato_omnia', '>', 0)
          ->orderBy('numero_pratica', 'desc'); //stato pratica: aperte o ss. legale
        
        $pratiche_query = $this->filtraPratiche($request, $pratiche_query);
        $pratiche = $pratiche_query->get();
        
        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.liquidato_omnia', compact('filiale', 'filiali', 'pratiche', 'request'));
    }
    
    public function importoSospeso(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $pratiche_query = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->whereIn('stato_pratica', [0, 3])
          ->where('importo_sospeso', '>', 0)
          ->orderBy('numero_pratica', 'desc'); //stato pratica: aperte o ss. legale

        $pratiche_query = $this->filtraPratiche($request, $pratiche_query);
        $pratiche = $pratiche_query->get();
        
        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.importo_sospeso', compact('filiale', 'filiali', 'pratiche', 'request'));
    }
    
    public function parcellaPresunta(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $pratiche_query = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->whereIn('stato_pratica', [0, 3])
          ->where('parcella_presunta', '>', 0)
          ->orderBy('numero_pratica', 'desc'); //stato pratica: aperte o ss. legale
        
        $pratiche_query = $this->filtraPratiche($request, $pratiche_query);
        $pratiche = $pratiche_query->get();
        
        
        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.parcella_presunta', compact('filiale', 'filiali', 'pratiche', 'request'));
    }
    
    public function onorari(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $pratiche_query = \App\Pratica::whereHas('cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->whereIn('stato_pratica', [0, 3])
          ->where('onorari', '>', 0)
          ->orderBy('numero_pratica', 'desc'); //stato pratica: aperte o ss. legale
        
        $pratiche_query = $this->filtraPratiche($request, $pratiche_query);
        $pratiche = $pratiche_query->get();

        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.onorari', compact('filiale', 'filiali', 'pratiche', 'request'));
    }
    
    public function sospesiMedici(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('visualizzare-pannello-filiale', $filiale)) {
            // L'utente non puo' visualizzare il pannello filiale di altre filiali
            abort(403);
        }
        
        $prestazioni = \App\PrestazioneMedica::whereHas('pratica.cliente', function($query) use ($filiale_id) {
            $query->where('filiale_id', $filiale_id);
        })->where('percentuale', '>', 0) // in convenzione
          ->where('sospeso', '=', true) // sospese
          ->whereHas('pratica', function($query) use ($request) {
            $this->filtraPratiche($request, $query);    
        })->orderBy('pratica_id', 'desc')->get();
        
        
        $filiali = \App\Filiale::all();

        return view('pannello_filiale.sospesi_medici', compact('filiale', 'filiali', 'prestazioni', 'request'));
    }
    
    public function fatture(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        
        if($request->user()->cannot('generare-fatture')) {
            abort(403);
        }
        
        $fattureElys = \App\Fattura::where('appartenenza', 1)->orderByRaw('YEAR(data_emissione) DESC, numero ASC')->get();
        $fattureElisir = \App\Fattura::where('appartenenza', 2)->orderByRaw('YEAR(data_emissione) DESC, numero ASC')->get();
        $fattureGroup = \App\Fattura::where('appartenenza', 3)->orderByRaw('YEAR(data_emissione) DESC, numero ASC')->get();
        
        $filiali = \App\Filiale::all();
        
        return view('pannello_filiale.fatture', compact('fattureElys', 'fattureElisir', 'fattureGroup', 'filiali', 'filiale'));
    }
    
    private function filtraPratiche(Request $request, $pratiche_query) {
        $numero_pratica_gt = $request->numero_pratica_gt;
        $numero_pratica_lt = $request->numero_pratica_lt;

        if ($numero_pratica_gt != NULL && $numero_pratica_lt != NULL) {
            // sono entrambi con valore
            $pratiche_query = $pratiche_query->whereBetween('numero_pratica', [$numero_pratica_gt, $numero_pratica_lt]);
        } else if ($numero_pratica_gt != NULL) {
            $pratiche_query = $pratiche_query->where('numero_pratica', '>=', $numero_pratica_gt);
        } else if ($numero_pratica_lt != NULL) {
            $pratiche_query = $pratiche_query->where('numero_pratica', '<=', $numero_pratica_lt);
        }
        
        $mese_apertura = $request->mese_apertura;
        if ($mese_apertura != NULL) {
            list($mese, $anno) = explode('/', $mese_apertura);
            $pratiche_query = $pratiche_query->whereMonth('data_apertura', '=', $mese)
                                             ->whereYear('data_apertura', '=', $anno);
        }
        
        return $pratiche_query;
    }
}
