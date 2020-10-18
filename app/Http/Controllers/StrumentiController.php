<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class StrumentiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('conferma-promemoria');
    }

    public function index(Request $request)
    {
        if ($request->user()->cannot('generare-export')) {
            // L'utente non ha il permesso di generare documenti di pratiche di altre filiali
            abort(403);
        }

        return view('strumenti.index');
    }

    public function exportClients(Request $request)
    {
        if ($request->user()->cannot('generare-export')) {
            // L'utente non ha il permesso di generare documenti di pratiche di altre filiali
            abort(403);
        }

        $columns = ['Nome', 'Cognome', 'Email', 'Cellulare', 'Telefono'];
        $rows = Cliente::all()->map(function ($cliente) {
            return [
                "{$cliente->nome}",
                "{$cliente->cognome}",
                "{$cliente->email}",
                "{$cliente->cellulare}",
                "{$cliente->telefono}",
            ];
        });

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=exportClienti.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        $callback = function () use ($columns, $rows) {
            $file = fopen('php://output', 'w');
            fwrite($file, "sep=,\n");
            fputcsv($file, $columns);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
