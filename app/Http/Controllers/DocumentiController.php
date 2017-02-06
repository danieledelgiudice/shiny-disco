<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Storage;
use File;

class DocumentiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('conferma-promemoria');
    }
    
    public function show(Request $request, $cliente_id, $pratica_id, $documento_id)
    {
        $documento = \App\Documento::findOrFail($documento_id);

        if ($documento->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica del documento
            abort(404);
        }
        
        if ($documento->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if ($request->user()->cannot('visualizzare-pratica', $documento->pratica)) {
            // L'utente non ha il permesso vedere documenti di pratiche di altre filiali
            abort(403);
        }
        
        $contents = Storage::disk('local_documents')->get($documento->nome_file);
        
        return response($contents, 200)->header('Content-Type', $documento->mime)
                                       ->header('Content-Disposition', 'inline; filename="'.$documento->nome_file_originale.'"');
    }
    
    public function create(Request $request)
    {
        return view('documenti.create');
    }
    
    public function store(Request $request)
    {
        $file = $request->documento;
        
        if(!($file && $file->isValid())) {
            return response()->json('Si è verificato un errore durante il caricamento del file', 400);
        }
        
		$ext = $file->getClientOriginalExtension();
		$mime = $file->getClientMimeType();
		$original_name = $file->getClientOriginalName();
		
		$storage_name = time() . uniqid() . ".$ext";
		
		$matches = [];
		if (!preg_match('/(\d+?)\s*(.+)/i', $original_name, $matches)) {
            return response()->json('Il file non presenta la struttura del nome adatta: "npratica descrizione"', 400);
        }
        
        $numero_pratica = $matches[1];
        $descrizione = $matches[2];
        $pratica = \App\Pratica::where('numero_pratica', '=', $numero_pratica)->first();
        
        if(!$pratica) {
            return response()->json('Il numero della pratica è invalido', 400);
        }
        
        if ($request->user()->cannot('modificare-pratica', $pratica)) {
            // L'utente non ha il permesso di salvare documenti in questa pratica
            return response()->json('Il numero della pratica è invalido', 403);
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
    
    public function destroy(Request $request, $cliente_id, $pratica_id, $documento_id)
    {
        $documento = \App\Documento::findOrFail($documento_id);

        if ($documento->pratica->id != $pratica_id) {
            // La pratica nell'url non corrisponde alla pratica del documento
            abort(404);
        }
        
        if ($documento->pratica->cliente->id != $cliente_id) {
            // Il cliente nell'url non corrisponde al cliente della pratica
            abort(404);
        }
        
        if ($request->user()->cannot('modificare-pratica', $documento->pratica)) {
            // L'utente non ha il permesso vedere documenti di pratiche di altre filiali
            abort(403);
        }
        
        Storage::disk('local_documents')->delete($documento->nome_file);
        $documento->delete();
        
        return redirect()->action('PraticheController@show', ['cliente' => $documento->pratica->cliente, 'pratica' => $documento->pratica])
            ->with('success', 'Il documento è stato eliminato con successo.');
    }
}
