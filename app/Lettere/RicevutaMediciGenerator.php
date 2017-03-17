<?php

namespace App\Lettere;

class RicevutaMediciGenerator
{
    const REQUIRES = '2';
    const NAME = "Ricevuta medici";

    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $prestazioni = $data['prestazioni'];
        $totale = $data['totale'] + 0;
        $onorari = $data['onorari'] + 0;
        $varie = $data['varie'] + 0;
        $nascondi_percentuali = isset($data['nascondi_percentuali']);
        
        $prestazioni = $prestazioni->where('inConvenzione', true);

        $totale_importo = $prestazioni->sum('costo');
        $totale_diritti = $prestazioni->sum(function($p) {
            return $p->costo * $p->percentuale / 100;
        });
        $totale_a_pagare = $totale_importo - $totale_diritti;
        $da_rimettere = $onorari + $varie + $totale_importo;
        $netto = $totale - $da_rimettere;

        $totale = format_money($totale);
        $onorari = format_money($onorari);
        $varie = format_money($varie);
        $totale_importo = format_money($totale_importo);
        $totale_diritti = format_money($totale_diritti);
        $totale_a_pagare = format_money($totale_a_pagare);
        $da_rimettere = format_money($da_rimettere);
        $netto = format_money($netto);
        
        $lineh = 7;

        // $template = iconv('UTF-8', 'windows-1252', $template);

        $f = new \fpdf\FPDF();
        $f->SetTitle($this::NAME);
        $f->SetMargins(15, 15);
        $f->AddPage();

        $f->SetFont('Times', '', 10);
        $today = format_date(\Carbon\Carbon::now());
        $str = "Livorno {$today}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(15, 15);
        $f->MultiCell(0, $lineh, $str, 0);

        $f->SetY($f->getY() + 3);
        $str = "SPETT.LE ELY'S CONSULENZE";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0);

        $f->SetY($f->getY() + 3);
        $data_sinistro = format_date(\Carbon\Carbon::parse($pratica['data_sinistro']));
        $str = "Io sottoscritto {$cliente['cognome']} {$cliente['nome']} in riferimento al sinistro a me occorso in data {$data_sinistro} con controparte {$pratica['assicurazione_controparte']} e per il quale a suo tempo vi ho conferito mandato per la trattazione e definizione in sede stragiudiziale dichiaro di accettare a totale definizione e transazione la somma di {$totale} omnia, prendo atto e accetto che tale somma e' comprensiva di: ";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->Write($lineh, $str, 0);
        $f->Ln();
        $list = [["{$onorari}",  'per onorari e spese a voi spettanti'],
                ["{$totale_importo}", 'per spese mediche da voi anticipatemi e da me non ancora pagate' ],
                ["{$varie}", 'per spese varie da voi anticipatemi e da me non ancora pagate']];
        foreach ($list as $i => $row) {
            $f->SetX(20);
            $j = $i + 1;
            $str = iconv('UTF-8', 'windows-1252', "{$j})");
            $f->Write($lineh, $str, 0);
            $f->SetX(25);
            $str = iconv('UTF-8', 'windows-1252', $row[0]);
            $f->Cell(25, $lineh, $str, 0, 0, 'R');
            $f->SetX(50);
            $str = iconv('UTF-8', 'windows-1252', $row[1]);
            $f->Write($lineh, $str, 0);
            $f->Ln();
        }

        $f->SetY($f->getY() + 3);
        $data_sinistro = format_date(\Carbon\Carbon::parse($pratica['data_sinistro']));
        $str = "Mi impegno quindi a rimettervi l'importo di {$da_rimettere} pari alla somma di cui al punto 1-2-3 entro e non oltre 5 giorni dalla data presente. L'importo netto che dichiaro di accettare ammonta quindi a {$netto}.";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->Write($lineh, $str, 0);

        $f->SetY($f->getY() + 10);

        $f->SetFont('Times', 'BU', 10);


        $str = "SPESE MEDICHE";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str, 0, 'C');

        $f->SetFont('Times', 'B', 10);

        $f->SetY($f->GetY() + 4);

        $rowY = $f->GetY();
        $maxY = $rowY;

        $f->SetXY(20, $rowY);
        $s = "MEDICO";
        $s = iconv('UTF-8', 'windows-1252', $s);
        $f->MultiCell($nascondi_percentuali ? 60 : 30, $lineh, $s);
        if ($f->GetY() > $maxY) $maxY = $f->GetY();

        $f->SetXY($nascondi_percentuali ? 90 : 50, $rowY);
        $s = "IMPORTO";
        $s = iconv('UTF-8', 'windows-1252', $s);
        $f->MultiCell($nascondi_percentuali ? 30 : 20, $lineh, $s, 0, 'R');
        if ($f->GetY() > $maxY) $maxY = $f->GetY();

        
        if (!$nascondi_percentuali) {
            $f->SetXY(70, $rowY);
            $s = '%';
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->MultiCell(10, $lineh, $s, 0, 'R');
            if ($f->GetY() > $maxY) $maxY = $f->GetY();
    
            $f->SetXY(80, $rowY);
            $s = 'DIRITTI';
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->MultiCell(20, $lineh, $s, 0, 'R');
            if ($f->GetY() > $maxY) $maxY = $f->GetY();
    
            $f->SetXY(100, $rowY);
            $s = 'A PAGARE';
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->MultiCell(25, $lineh, $s, 0, 'R');
            if ($f->GetY() > $maxY) $maxY = $f->GetY();
        }

        $f->SetXY(130, $rowY);
        $s = 'DATA E FIRMA PROFESSIONISTA';
        $s = iconv('UTF-8', 'windows-1252', $s);
        $f->MultiCell(0, $lineh, $s);
        if ($f->GetY() > $maxY) $maxY = $f->GetY();

        $f->SetFont('Times', '', 10);


        $f->setY($maxY);

        foreach ($prestazioni->groupBy('nome_medico') as $nome => $p) {
            $rowY = $f->GetY();
            $maxY = $rowY;

            $f->SetXY(20, $rowY);
            $s = strtoupper($nome);
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->MultiCell($nascondi_percentuali ? 60 : 30, $lineh, $s);
            if ($f->GetY() > $maxY) $maxY = $f->GetY();

            $f->SetXY($nascondi_percentuali ? 90 : 50, $rowY);
            $s = format_money($p->sum('costo'));
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->MultiCell($nascondi_percentuali ? 30 : 20, $lineh, $s, 0, 'R');
            if ($f->GetY() > $maxY) $maxY = $f->GetY();

            if (!$nascondi_percentuali) {
                $f->SetXY(70, $rowY);
                $s = $p[0]->percentuale;
                $s = iconv('UTF-8', 'windows-1252', $s);
                $f->MultiCell(10, $lineh, $s, 0, 'R');
                if ($f->GetY() > $maxY) $maxY = $f->GetY();
    
                $f->SetXY(80, $rowY);
                $s = format_money($p->sum('quantitaPercentuale'));
                $s = iconv('UTF-8', 'windows-1252', $s);
                $f->MultiCell(20, $lineh, $s, 0, 'R');
                if ($f->GetY() > $maxY) $maxY = $f->GetY();
    
                $f->SetXY(100, $rowY);
                $s = format_money($p->sum('aPagare'));
                $s = iconv('UTF-8', 'windows-1252', $s);
                $f->MultiCell(25, $lineh, $s, 0, 'R');
                if ($f->GetY() > $maxY) $maxY = $f->GetY();                
            }

            $f->Line(130, $maxY - 2, 200, $maxY - 2);

            $f->SetY($maxY);
        }

        $rowY = $f->GetY();

        $f->SetFont('Times', 'B', 10);
        $f->SetXY(20, $rowY);
        $s = "TOTALI";
        $s = iconv('UTF-8', 'windows-1252', $s);
        $f->MultiCell($nascondi_percentuali ? 60 : 30, $lineh, $s);

        $f->SetXY($nascondi_percentuali ? 90 : 50, $rowY);
        $s = "{$totale_importo}";
        $s = iconv('UTF-8', 'windows-1252', $s);
        $f->MultiCell($nascondi_percentuali ? 30 : 20, $lineh, $s, 0, 'R');

        if(!$nascondi_percentuali) {
            $f->SetXY(80, $rowY);
            $s = "{$totale_diritti}";
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->MultiCell(20, $lineh, $s, 0, 'R');
    
            $f->SetXY(100, $rowY);
            $s = "{$totale_a_pagare}";
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->MultiCell(25, $lineh, $s, 0, 'R');            
        }

        $f->SetFont('Times', '', 10);

        $f->Ln();

        $f->SetX(110);
        $str = "FIRMA";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);

        $f->SetX(110);
        $str = "{$cliente['cognome']} {$cliente['nome']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);


        $f->SetY($f->GetY() + 30);
        $f->SetTextColor(90);
        $f->SetDrawColor(90);
        $str = "Dichiaro inoltre di ritirare come in effetti ritiro l'assegno:
Numero:
Per euro:
Su banca:";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetX(15);
        $f->Write($lineh, $str);

        $f->Line(32, $f->GetY() - $lineh - 2, 80, $f->GetY() - $lineh - 2);
        $f->Line(32, $f->GetY() - 2, 80, $f->GetY() - 2);
        $f->Line(32, $f->GetY() + $lineh - 2, 80, $f->GetY() + $lineh - 2);

        $f->Ln();

        $f->SetX(110);
        $str = "FIRMA";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);

        $f->SetX(110);
        $str = "{$cliente['cognome']} {$cliente['nome']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);

        ob_get_clean();
        return $f->Output($this::NAME.'.pdf', 'I');

    }
}
