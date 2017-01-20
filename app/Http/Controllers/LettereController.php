<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class LettereController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show(Request $request, $cliente_id, $pratica_id, $lettera_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);

        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if ($request->user()->cannot('generare-lettera', $pratica)) {
            // L'utente non ha il permesso di generare documenti di pratiche di altre filiali
            abort(403);
        }
        
        $f = new \App\Lettere\LettereFactory;
        $f->dataSource(['cliente' => $pratica->cliente,
                        'professione' => $pratica->cliente->professione,
                        'pratica' => $pratica,
                        'autorita' => $pratica->autorita,
                        'assicurazione_parte' => $pratica->assicurazione_parte,
                        'assicurazione_controparte' => $pratica->assicurazione_controparte,]);
        
        $lettera = $f->generate($lettera_id);
        
        return $lettera;
    }
}
