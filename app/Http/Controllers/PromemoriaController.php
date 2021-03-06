<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class PromemoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only('indexAll');
        $this->middleware('conferma-promemoria')->except(['indexToday', 'confermaLettura']);
    }

    public function indexToday(Request $request, $filiale_id = null)
    {
        if ($filiale_id === null)
            return redirect()->action('PromemoriaController@indexToday', ['filiale' => $request->user()->filiale->id ]);

        if ($filiale_id != 0) {
            $filiale = \App\Filiale::findOrFail($filiale_id);

            if($request->user()->cannot('visualizzare-agenda', $filiale)) {
                // L'utente non può vedere l'agenda di altre filiali
                abort(403);
            }

            $promemoria = \App\Promemoria::where('quando', \Carbon\Carbon::today())
                        ->whereHas('pratica.cliente.filiale', function($query) use ($filiale) {
                            $query->where('id', $filiale->id);
                        })->oldest('quando');
            
            if($request->user()->cannot('visualizzare-agenda-estesa', null)) {
                $promemoria = $promemoria->where('chi', '<>', 'Elisa');
            }            
                
            $promemoria = $promemoria->get();

            $chis = \App\Promemoria::whereHas('pratica.cliente.filiale', function($query) use ($filiale) {
                $query->where('id', $filiale->id);
            })->select('chi')->distinct()->pluck('chi')->all();
        } else {

            if($request->user()->cannot('visualizzare-agenda-estesa', null)) {
                // L'utente non può vedere l'agenda estesa
                abort(403);
            }

            $promemoria = \App\Promemoria::where('quando', \Carbon\Carbon::today())->oldest('quando')->get();

            $chis = \App\Promemoria::select('chi')->distinct()->pluck('chi')->all();

            $filiale = 0;
        }

        $chis = array_combine($chis, $chis);

        $filiali = \App\Filiale::all();

        $da_confermare = (!$request->user()->isAdmin()) && $request->user()->ultima_conferma < \Carbon\Carbon::today();

        return view('promemoria.indexToday', compact('filiale', 'promemoria', 'filiali', 'da_confermare', 'chis'));
    }

    public function indexAll(Request $request, $filiale_id = null)
    {
        if (!$filiale_id)
            return redirect()->action('PromemoriaController@indexAll', ['filiale' => $request->user()->filiale->id ]);

        $filiale = \App\Filiale::findOrFail($filiale_id);

        if($request->user()->cannot('visualizzare-agenda-estesa', $filiale)) {
            // L'utente non può vedere l'agenda estesa
            abort(403);
        }

        $promemoria = \App\Promemoria::withTrashed()
                    ->whereHas('pratica.cliente.filiale', function($query) use ($filiale) {
                        $query->where('id', $filiale->id);
                    })->latest('quando')->filter($request->all())->paginate(50);
        $filiali = \App\Filiale::all();
        $numero_pratica = $request->pratica_numero_pratica;
        return view('promemoria.indexAll', compact('filiale', 'promemoria', 'filiali', 'numero_pratica'));
    }


    public function store(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);

        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }

        if($request->user()->cannot('modificare-agenda', $pratica)) {
            // L'utente non può modificare l'agenda
            abort(403);
        }

        $this->validateInput($request);

        $promemoria = new \App\Promemoria;
        $promemoria->fill($request->all());

        $promemoria->pratica()->associate($pratica);
        $promemoria->save();

        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica]);
    }

    public function destroy(Request $request, $cliente_id, $pratica_id, $promemoria_id)
    {
        $promemoria = \App\Promemoria::findOrFail($promemoria_id);

        if ($promemoria->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica del promemoria
            abort(404);
        }

        if ($promemoria->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }

        if($request->user()->cannot('completare-promemoria', $promemoria->pratica)) {
            // L'utente non può completare promemoria di pratiche di altre filiali
            abort(403);
        }
        
        if(!$request->user()->isAdmin() && $promemoria->chi === 'Elisa') {
            // L'utente non può completare promemoria di Elisa
            abort(403);
        }

        $promemoria->delete();

        return redirect()->back()->with('success', 'Il promemoria è stato eliminato con successo.');
    }

    public function confermaLettura(Request $request)
    {
        $utente = $request->user();
        $utente->ultima_conferma = \Carbon\Carbon::now();
        $utente->save();

        return redirect()->back()->with('success', 'Hai confermato di aver letto l\'agenda di oggi.');
    }

    public function filter(Request $request, $filiale_id)
    {
        if ($filiale_id != 0) {
            $filiale = \App\Filiale::findOrFail($filiale_id);

            $promemoria = \App\Promemoria::whereHas('pratica.cliente.filiale', function($query) use ($filiale) {
                            $query->where('id', $filiale->id);
                        })->filter($request->all())->latest('quando');
            
            if($request->user()->cannot('visualizzare-agenda-estesa', null)) {
                // L'utente non può vedere l'agenda estesa
                $promemoria = $promemoria->where('chi', '<>', 'Elisa');
            }
            
            $promemoria = $promemoria->get();
            
        } else {
            if($request->user()->cannot('visualizzare-agenda-estesa', null)) {
                // L'utente non può vedere l'agenda estesa
                abort(403);
            }
            $promemoria = \App\Promemoria::filter($request->all())->latest('quando')->get();
        }

        return view('promemoria._tabella', compact('promemoria'));
    }

    public function update(Request $request, $cliente_id, $pratica_id, $promemoria_id)
    {
        $promemoria = \App\Promemoria::findOrFail($promemoria_id);

        if ($promemoria->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica del promemoria
            abort(404);
        }

        if ($promemoria->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }

        if($request->user()->cannot('modificare-agenda', $promemoria->pratica)) {
            // L'utente non può modificare assegni di pratiche di altre filiali
            abort(403);
        }

        $this->validateInput($request);
        $promemoria->fill($request->all());
        $promemoria->save();

        $result = $promemoria->toArray();
        $result['quando'] = date_diff_days(\Carbon\Carbon::parse($result['quando']));

        return response()->json($result, 200);
    }

    private function validateInput(Request $request)
    {
        $this->validate($request, [
            'chi'              => 'required|max:255',
            'quando'           => 'required|date_format:d/m/Y',
            'cosa'             => 'required',
        ]);
    }
}
