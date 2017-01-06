<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class PraticheController extends Controller
{
    public function index(Request $request)
    {
        $pratiche = \App\Pratica::all();
        return view('pratiche.index', compact('pratiche'));
    }
    
    public function show($id)
    {
    }

    public function edit($id)
    {
        $pratica = \App\Pratica::find($id);
        return view('pratiche.edit', compact('pratica'));
    }

    public function update(Request $request, $id)
    {
        $pratica = \App\Pratica::find($id);
        $new_values = $request->all();
        
        $pratica->fill($new_values);
        $pratica->save();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('PraticheController@show', $pratica)->with('success', 'Pratica salvato con successo!');
    }
}
