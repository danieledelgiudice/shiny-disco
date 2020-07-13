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
        $this->middleware('conferma-promemoria');
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

        if ($request->logo && $request->user()->cannot('scegliere-logo')) {
            // L'utente non ha il permesso di generare documenti con logo elisir
            abort(403);
        }
        
        switch($request->logo) {
            case 1:
                $logo = 'elisir.png';
                break;
            case 2:
                $logo = 'group.jpg';
                break;
            default:
                $logo = 'elys.jpg';
                break;
        }

        $f = new \App\Lettere\LettereFactory;
        $source = [
            'cliente' => $pratica->cliente,
            'professione' => $pratica->cliente->professione,
            'pratica' => $pratica,
            'autorita' => $pratica->autorita,
            'prestazioni' => $pratica->prestazioni_mediche,
            'logo' => $logo,
        ];

        foreach ($request->all() as $name => $value)
            if ($name !== 'logo')
                $source[$name] = $value;

        $f->dataSource($source);

        return $f->generate($lettera_id);
    }

    public function showOptions(Request $request, $cliente_id, $pratica_id)
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
        $lettere = $f->listGenerators();

        $can_choose_logo = $request->user()->can('scegliere-logo');

        return view('lettere.options', compact('lettere', 'pratica', 'can_choose_logo'));
    }
}
