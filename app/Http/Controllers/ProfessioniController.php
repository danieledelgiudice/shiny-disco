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
        if ($request->nome)
            \App\Professione::create(['nome' => $request->nome]);
        return redirect()->back();
    }
}
