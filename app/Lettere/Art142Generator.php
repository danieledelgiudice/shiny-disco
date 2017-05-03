<?php

namespace App\Lettere;

class Art142Generator
{
    const REQUIRES = '0';
    const NAME = "Articolo 142";

    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $professione = $data['professione'];

        $pratica['data_sinistro'] = format_date(\Carbon\Carbon::parse($pratica['data_sinistro']));
        $cliente['data_nascita'] = format_date(\Carbon\Carbon::parse($cliente['data_nascita']));
        $today = format_date(\Carbon\Carbon::today());
        
        $reddito = format_money($cliente['reddito']);
        
        $f = new \fpdf\FPDF();
        $f->SetTitle($this::NAME);
        $f->SetMargins(20, 20);
        $f->AddPage();

        $f->SetFont('Times', '', 11);
        
        $str = "Livorno, {$today}
        Spett.le {$pratica['assicurazione_risarcente']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->Write(7, $str);
        $f->Ln();
        $f->Ln();

        $template = "Con riferimento al sinistro accaduto il {$pratica['data_sinistro']} in località {$pratica['luogo_sinistro']} il sottoscritto {$cliente['cognome']} {$cliente['nome']}, nato il {$cliente['data_nascita']} a {$cliente['citta_nascita']} residente a {$cliente['citta_residenza']} ({$cliente['provincia']}) in {$cliente['via']}, Codice Fiscale {$cliente['codice_fiscale']}, professione {$cliente['professione']['nome']}, reddito {$reddito} 
ai sensi e agli effetti dell’art. 142 del DLgs 7 settembre 2005, n. 209, Codice delle assicurazioni private, consapevole della responsabilità, anche penale, cui va incontro in caso di dichiarazioni non veritiere

D I C H I A R A

Di: non avere diritto a prestazioni di parte di Istituti che gestiscono assicurazioni obbligatorie
Di: avere diritto a prestazioni di parte di Istituti che gestiscono assicurazioni obbligatorie e precisamente da:
          INPS per l’indennità economica di malattia
          INPS per l’assegno d’invalidità o la pensione d’inabilità ai sensi della legge 222/84
          INPS per pensioni, assegni e indennità spettanti agli invalidi civili ai sensi della legge 183/2010
          INAIL ai sensi del T.U. 1124/65 così come modificato da D.Lgs. 38/00";

        $template = iconv('UTF-8', 'windows-1252', $template);

        
        $f->Write(7, $template);

        $f->SetY($f->GetY() + 20);
        $f->Write(7, "Altro");
        $f->Line($f->GetX() + 4, $f->GetY() + 6, 180, $f->GetY() + 6);

        $f->SetY($f->GetY() + 10);
        $f->Write(7, "Luogo e Data");
        $f->Line($f->GetX() + 4, $f->GetY() + 6, 100, $f->GetY() + 6);

        $f->SetY($f->GetY() + 10);
        $f->Write(7, "Firma");
        $f->Line($f->GetX() + 4, $f->GetY() + 6, 100, $f->GetY() + 6);

        ob_get_clean();
        return $f->Output($this::NAME.'.pdf', 'I');
    }
}
