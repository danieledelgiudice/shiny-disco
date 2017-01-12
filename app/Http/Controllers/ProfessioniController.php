<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessioniController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        if ($request->nome) {
            $professione = \App\Professione::create(['nome' => $request->nome]);
            
            return response()->json(['id' => $professione->id, 'nome' => $professione->nome], 200); //redirect()->back();
        }
    }
}
