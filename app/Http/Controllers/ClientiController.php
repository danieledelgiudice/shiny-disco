<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ClientiController extends Controller
{
    public function index(Request $request)
    {
        $clienti = \App\Cliente::all();
        return $clienti;
    }

    public function edit($id)
    {
        $cliente = \App\Cliente::find($id);
        // return $cliente->toArray();
        return view('clienti.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        // $city = \App\City::find($id);
        
        // $city->fill([
        //     'name' => $request->name,
        //     'district' => $request->district,
        //     'population' => $request->population,
        // ]);
        // $city->save();
        
        // return redirect(action('CityController@index'));
    }
}
