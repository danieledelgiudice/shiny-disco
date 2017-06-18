<?php

namespace App\Lettere;

class ModelloSoldiGenerator
{
    const REQUIRES = '0';
    const NAME = "Modello consegna denaro (nome temporaneo)";

    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $professione = $data['professione'];

        $lineh = 7;

        $f = new \fpdf\FPDF();
        $f->SetTitle($this::NAME);
        $f->SetMargins(20, 20);
        $f->AddPage();
        $f->SetFont('Times', '', 11);

        $str = "Livorno " . format_date(\Carbon\Carbon::today()) . "\n n.p. " . $pratica['numero_pratica'];
        $f->SetXY(20, 60);
        $f->MultiCell(0, $lineh, $str);
        
        $str = "In data odierna consegniamo al /alla Sig. Sig.ra
[] Sig. /Sig.ra {$cliente['cognome']} {$cliente['nome']} (per comodità chiamato ricevente)
[] Sig. /Sig.ra ___________________________ delegato dal Sig. _________________________________ (per comodità chiamato ricevente)
[] Sig. /Sig.ra ___________________________ (per comodità chiamato ricevente)

la somma di € ______________,____ tramite

[] bonifico
[] contante
[] assegno        [] circolare      [] bancario   n. _____________________________
      su banca ______________________________________________________________

a titolo di:
__________________________________________________________________________________
__________________________________________________________________________________
__________________________________________________________________________________
__________________________________________________________________________________
__________________________________________________________________________________

Il ricevente si impegna a rimetterci la somma di € ______________,____ entro e non oltre _________ giorni dalla presente a titolo di ______________________________________

                                                         Firma del ricevente

Firma del Sig. _________________________________ quale obbligato in solido

                                                         _______________________________________";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->Write($lineh, $str);

        return $f->Output($this::NAME.'.pdf', 'I');

    }
}
