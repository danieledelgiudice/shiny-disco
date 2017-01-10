<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ClientiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $clienti_filiale = \App\Cliente::where('filiale_id', $this->filialeUtente()->id);
        $clienti = $clienti_filiale->filter($request->all())->get();
        
        return view('clienti.index', compact('clienti'));
    }

    public function show($id)
    {
        $cliente = \App\Cliente::find($id);
        
        if ($cliente->filiale != $this->filialeUtente()) {
            // L'utente sta cercando di accedere ad un cliente che non gli appartiene
            abort(403);
        }
        
        $pratiche = $cliente->pratiche()->latest('data_apertura')->get();
        
        return view('clienti.show', compact('cliente', 'pratiche'));
    }

    public function edit($id)
    {
        $cliente = \App\Cliente::find($id);
        
        if ($cliente->filiale != $this->filialeUtente()) {
            // L'utente sta cercando di accedere ad un cliente che non gli appartiene
            abort(403);
        }
        
        return view('clienti.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = \App\Cliente::find($id);
        
        if ($cliente->filiale != $this->filialeUtente()) {
            // L'utente sta cercando di accedere ad un cliente che non gli appartiene
            abort(403);
        }
        
        $new_values = $request->all();
        
        $cliente->fill($new_values);
        $cliente->save();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('ClientiController@show', $cliente)->with('success', 'Cliente salvato con successo!');
    }
    
    public function create()
    {
        return view('clienti.create');
    }
    
    public function store(Request $request)
    {
        $cliente = new \App\Cliente;
        $new_values = $request->all();
        
        $filiale = $this->filialeUtente();
        
        $cliente->fill($new_values);
        $cliente->filiale()->associate($filiale);
        
        $cliente->save();
        
        // TODO: mostrare messaggio nella view
        return redirect()->action('ClientiController@show', $cliente)->with('success', 'Cliente salvato con successo!');
    }
    
    public function filter(Request $request)
    {
        $params = [];
        foreach($request->all() as $k => $v)
        {
            if ($k[0] != '_' && $v != '')
                $params[$k] = $v;
        }
        
        $query = http_build_query($params);
        // return dd($params);
        return redirect()->action('ClientiController@index', $query);
    }
    
    //Questa funzione è presente anche su PraticheController, un giorno mi ringrazierai Dani.
    private function filialeUtente()
    {
        $user = Auth::user();
        return $user->filiale;
    }
}
