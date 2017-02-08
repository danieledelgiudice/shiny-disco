<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;


class FilialiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
        $this->middleware('conferma-promemoria');
    }
    
    public function index(Request $request)
    {
        $filiali = \App\Filiale::all();
        
        return view('filiali.index', compact('filiali'));
    }
    
    public function edit(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        $utente = $filiale->utente;
        
        return view('filiali.edit', compact('filiale', 'utente'));
    }
    
    public function update(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);

        $this->validateInput($request);
        
        $filiale->fill($request->all());
        $filiale->save();
        
        if ($request->password) {
            $utente = $filiale->utente;
            $utente->password = Hash::make($request->password);
            $utente->save();
        }
        
        return redirect()->action('FilialiController@index')->with('success', 'La filiale è stata modificata con successo.');
    }
    
    public function create(Request $request)
    {
        return view('filiali.create');
    }
    
    public function store(Request $request)
    {
        $this->validateInput($request);
        $this->validate($request, [
            'password'  => 'required'
        ]);
        
        $filiale = new \App\Filiale;
        
        $filiale->fill($request->all());
        $filiale->save();
        
        $utente = new \App\User;
        $utente->password = Hash::make($request->password);
        $utente->filiale()->associate($filiale);
        $utente->save();
        
        return redirect()->action('FilialiController@index')->with('success', 'La filiale è stata eliminata con successo.');
    }
    
    public function toggleEnabled(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        $utente = $filiale->utente;
        
        if ($utente == $request->user())
            // Non posso disattivare me stesso
            return redirect()->back()->with('danger', 'Non è possibile disattivare la propria filiale.');
        
        $utente->enabled = !$utente->enabled;
        $utente->save();
        
        $msg = $utente->enabled ? 'La filiale è stata riattivata' : 'La filiale è stata disattivata';
        return redirect()->back()->with('info', $msg);
    }
    
    public function toggleCanGenerateLetters(Request $request, $filiale_id)
    {
        $filiale = \App\Filiale::findOrFail($filiale_id);
        $utente = $filiale->utente;
        
        if ($utente == $request->user())
            // Non posso i permessi a me stesso
            return redirect()->back()->with('danger', 'Non è possibile impedire la generazione di lettere alla propria filiale.');
        
        $utente->can_generate_letters = !$utente->can_generate_letters;
        $utente->save();
        
        $msg = $utente->can_generate_letters ? 'La filiale adesso può generare lettere' : 'La filiale non può più generare lettere';
        return redirect()->back()->with('info', $msg);
    }
    
    private function validateInput(Request $request)
    {
        $this->validate($request, [
            'nome'                      => 'required|max:255',
            'indirizzo'                 => 'required|max:255',
            'telefono'                  => 'max:255',
            'password'                  => 'min:6|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/i|max:30',
        ]);
    }
}
