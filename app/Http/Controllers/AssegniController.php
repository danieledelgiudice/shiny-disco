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
        $pratica = \App\Pratica::find($pratica_id);
        if($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }
        
        return view('assegni.create', compact('pratica'));
    }
    
    public function store(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::find($pratica_id);
        if($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }
        
        $assegno = new \App\Assegno;
        $assegno->fill($request->all());
        
        $assegno->pratica()->associate($pratica);
        $assegno->save();
        
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica]);
    }
    
    public function edit(Request $request, $cliente_id, $pratica_id, $assegno_id)
    {
        $assegno = \App\Assegno::find($assegno_id);
        if($request->user()->cannot('modificare-pratica', $assegno->pratica)) {
            // L'utente non può aggiungere assegni a pratiche di altre filiali
            abort(403);
        }
        
        return view('assegni.edit', compact('assegno'));
    }
    
    public function update(Request $request, $cliente_id, $pratica_id, $assegno_id)
    {
        $pratica = \App\Pratica::find($pratica_id);
        if($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non può modificare assegni di pratiche di altre filiali
            abort(403);
        }
        
        $assegno = \App\Assegno::find($assegno_id);
        $assegno->fill($request->all());
        $assegno->save();
        
        return redirect()->action('PraticheController@show', ['cliente' => $pratica->cliente, 'pratica' => $pratica]);
    }
}
