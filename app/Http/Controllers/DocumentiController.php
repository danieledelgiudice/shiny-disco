<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Storage;
use File;

class DocumentiController extends Controller
{
    public function indexAll(Request $request)
    {
        $documenti = \App\Documento::all();
        
        return dd($documenti);
    }
    
    public function index(Request $request, $cliente_id, $pratica_id)
    {
        $pratica = \App\Pratica::find($pratica_id);
        $documenti = $pratica->documenti()->get();
        
        return dd($documenti);
    }
    
    public function show(Request $request, $cliente_id, $pratica_id, $documento_id)
    {
        $documento = \App\Documento::find($documento_id);
        
        $contents = Storage::disk('local_documents')->get($documento->nome_file);
        
        return response($contents, 200)->header('Content-Type', $documento->mime);
    }
    
    public function create(Request $request, $cliente_id, $pratica_id)
    {
        $cliente = \App\Cliente::find($cliente_id);
        $pratica = \App\Pratica::find($pratica_id);
        
        return view('documenti.create', compact('cliente', 'pratica'));
    }
    
    public function store(Request $request, $cliente_id, $pratica_id)
    {
        $file = $request->documento;
        
		$ext = $file->getClientOriginalExtension();
		$mime = $file->getClientMimeType();
		$original_name = $file->getClientOriginalName();
		
		$storage_name = time() . uniqid() . ".$ext";

 		$path = Storage::disk('local_documents')->put($storage_name,  File::get($file));
		$documento = new \App\Documento;
		$documento->fill([
		    'descrizione' => $request->descrizione,
		    'categoria' => $request->categoria,
		    'nome_file' => $storage_name,
		    'nome_file_originale' => $original_name,
		    'mime' => $mime,
		    ]);
		    
		$documento->pratica()->associate(\App\Pratica::find($pratica_id));
		$documento->save();
        
        // TODO: aggiungere messaggio successo
        return redirect()->action('PraticheController@show', ['cliente' => $cliente_id, 'pratica' => $pratica_id]);
    }
}
