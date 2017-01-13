<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class CompagnieAssicurativeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        return dd($filiale->compagnieAssicurative()->get()->pluck('nome'));
    }
}
