<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class AssegniController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }
        
        return view('assegni.create', compact('pratica'));
    }
    
    public function store(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::findOrFail($pratica_id);
        
        if ($pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }
        
        $this->validate($request, [
            'data'              => 'required|date_format:d/m/Y',
            'importo'           => 'required|numeric|max:100000000',
            'banca'             => 'required|max:255',
            'tipologia'         => 'required|in:0,1',
            'data_azione'       => 'required|date_format:d/m/Y',
        ]);
        
        $assegno = new \App\Assegno;
        $assegno->fill($request->all());
        
        $assegno->pratica()->associate($pratica);
        $assegno->save();
        
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica]);
    }
    
    public function edit(Request $request, $cliente_id, $pratica_id, $assegno_id)
    {
        $assegno = \App\Assegno::findOrFail($assegno_id);
        
        if ($assegno->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica dell'assegno
            abort(404);
        }
        
        if ($assegno->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $assegno->pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }
        
        return view('assegni.edit', compact('assegno'));
    }
    
    public function update(Request $request, $cliente_id, $pratica_id, $assegno_id)
    {
        $assegno = \App\Assegno::findOrFail($assegno_id);
        
        if ($assegno->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica dell'assegno
            abort(404);
        }
        
        if ($assegno->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if($request->user()->cannot('modificare-pratica', $assegno->pratica)) {
            // L'utente non può modificare assegni di pratiche di altre filiali
            abort(403);
        }
        
        $this->validate($request, [
            'data'              => 'required|date_format:d/m/Y',
            'importo'           => 'required|numeric|max:100000000',
            'banca'             => 'required|max:255',
            'tipologia'         => 'required|in:0,1',
            'data_azione'       => 'required|date_format:d/m/Y',
        ]);
        
        $assegno->fill($request->all());
        $assegno->save();
        
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $assegno->pratica]);
    }
}
