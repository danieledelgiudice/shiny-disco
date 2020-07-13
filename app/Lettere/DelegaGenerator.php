<?php

namespace App\Lettere;

class DelegaGenerator
{
    const REQUIRES = '0';
    const NAME = "Delega ritiro verbali";

    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $professione = $data['professione'];

        $lineh = 8;

        // $template = iconv('UTF-8', 'windows-1252', $template);

        $f = new \fpdf\FPDF();
        $f->SetTitle($this::NAME);
        $f->SetMargins(20, 20);
        $f->AddPage();
        $f->SetY(100);

        $f->SetFont('Times', '', 14);
        $data_sinistro = format_date(\Carbon\Carbon::parse($pratica['data_sinistro']));
        $data_nascita = format_date(\Carbon\Carbon::parse($cliente['data_nascita']));
        $str = "Io sottoscritto {$cliente['nome']} {$cliente['cognome']} nato a {$cliente['citta_nascita']} il {$data_nascita} e residente in ${cliente['via']}, ${cliente['citta_residenza']}, delego lo studio Ely'S Consulenze sito in Piazza Attias 37 a Livorno a ritirare copia dei verbali redatti per il sinistro da me subito in data ${data_sinistro}.";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0);


        $f->Ln();
        $f->Ln();
        $f->Ln();
        $f->Ln();
        

        $str = "In fede";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0);

        $f->Ln();
        $f->Ln();

        $data_oggi = format_date(\Carbon\Carbon::today());
        $str = "Livorno, {$data_oggi}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0);

        ob_get_clean();
        return $f->Output($this::NAME.'.pdf', 'I');

    }
}
