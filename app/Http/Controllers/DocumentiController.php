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
    
    public function create(Request $request)
    {
        return view('documenti.create');
    }
    
    public function store(Request $request)
    {
        $file = $request->documento;
        
        if(!$file->isValid()) {
            return response()->json('Si è verificato un errore durante il caricamento del file', 400);
        }
        
		$ext = $file->getClientOriginalExtension();
		$mime = $file->getClientMimeType();
		$original_name = $file->getClientOriginalName();
		
		$storage_name = time() . uniqid() . ".$ext";
		
		$matches = [];
		if (!preg_match('/(\d+?)\s*-\s*(.+)/i', $original_name, $matches)) {
            return response()->json('Il file non presenta la struttura del nome adatta: "npratica - nome"', 400);
        }
        
        $numero_pratica = $matches[1];
        $descrizione = $matches[2];
        $pratica = \App\Pratica::where('numero_pratica', '=', $numero_pratica)->first();
        
        if(!$pratica) {
            return response()->json('Il numero della pratica è invalido', 400);
        }

 		$path = Storage::disk('local_documents')->put($storage_name,  File::get($file));
		$documento = new \App\Documento;
		$documento->fill([
		    'descrizione' => $descrizione,
		    'nome_file' => $storage_name,
		    'nome_file_originale' => $original_name,
		    'mime' => $mime,
		    ]);
		    
		$documento->pratica()->associate($pratica);
		$documento->save();
        
        // TODO: aggiungere messaggio successo
        return response()->json('success', 200);
    }
}
