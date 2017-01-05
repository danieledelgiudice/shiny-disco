<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class PraticheController extends Controller
{
    public function index(Request $request)
    {
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
    }
}
