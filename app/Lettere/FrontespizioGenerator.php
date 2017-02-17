<?php

namespace App\Lettere;

class FrontespizioGenerator
{
    const REQUIRES = '0';
    const NAME = "Frontespizio";

    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $professione = $data['professione'];

        $lineh = 11;

        // $template = iconv('UTF-8', 'windows-1252', $template);

        $f = new \fpdf\FPDF();
        $f->SetTitle($this::NAME);
        $f->SetMargins(20, 20);
        $f->AddPage();

        $f->SetFont('Times', '', 24);
        $str = "CODICE FILIALE: {$cliente['filiale_id']}/{$pratica['numero_pratica']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');



        $f->Ln();
        $f->SetFont('Times', 'U', 24);
        $str = "TIPO — DATA";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');

        $f->SetFont('Times', '', 24);
        $tipo_pratica = \App\Pratica::$enumTipoPratica[$pratica['tipo_pratica']];
        $data_sinistro = format_date(\Carbon\Carbon::parse($pratica['data_sinistro']));
        $str = "{$tipo_pratica} — {$data_sinistro}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');



        $f->Ln();
        $f->SetFont('Times', 'U', 24);
        $str = "ASSISTITO — TARGA";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');

        $f->SetFont('Times', '', 24);
        $str = "{$cliente['cognome']} {$cliente['nome']} — {$pratica['targa_parte']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');



        $f->Ln();
        $f->SetFont('Times', 'U', 24);
        $str = "IMPRESA RISARCENTE";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');

        $f->SetFont('Times', '', 24);
        $str = "{$pratica['assicurazione_risarcente']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');



        $f->Ln();
        $f->SetFont('Times', 'U', 24);
        $str = "RESPONSABILE — TARGA";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');

        $f->SetFont('Times', '', 24);
        $str = "{$pratica['conducente_controparte']} — {$pratica['targa_controparte']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');


        $f->Ln();
        $f->SetFont('Times', '', 24);
        $str = "SINISTRO DEL: {$data_sinistro}
LIQUIDA: {$pratica['liquidatore']}
REPERIBILITA': {$pratica['reperibilita_liquidatore']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);


        ob_get_clean();
        return $f->Output($this::NAME.'.pdf', 'I');

    }
}
