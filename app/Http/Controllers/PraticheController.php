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
        return view('pratiche.edit');
    }

    public function update(Request $request, $id)
    {
    }
}
