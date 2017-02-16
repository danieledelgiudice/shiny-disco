<?php

namespace App\Lettere;

class InterventoRCAGenerator
{
    const REQUIRES = '1';
    const NAME = "Intervento RCA";
   
    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $professione = $data['professione'];
        $autorita = $data['autorita'];

        $lineh = 6;
        
        // $template = iconv('UTF-8', 'windows-1252', $template);

        $f = new \fpdf\FPDF();
        $f->SetTitle($this::NAME);
        $f->SetMargins(20, 20);
        $f->AddPage();

        $logo_elisir = $data['logo'];
        $logo_url = \URL::asset("/images/logos/$logo_elisir");
        $f->Image($logo_url, 20, 15, 45);
        
        $f->SetFont('Times', '', 11);
        $str = "P.zza Attias 13 57100 Livorno
Tel 0586/941901 0586/895118 Linee 5 a ricerca automatica
Fax 0586 1730113
Resp. Uffici esterni 0586 1734753";
        $f->SetXY(80, 15);
        $f->MultiCell(0, $lineh, $str);
        
        $str = "Livorno " . format_date(\Carbon\Carbon::today()) . "\n n.p.";
        $f->SetXY(20, 60);
        $f->MultiCell(0, $lineh, $str);
        
        $str = "Spett.le {$pratica['assicurazione_risarcente']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(95, 70);
        $f->Cell(0, $lineh, $str);
        
        $str = "OGGETTO: ";
        $f->SetFont('Times', 'B', 11);
        $f->SetXY(20, 85);
        $f->Write($lineh, $str);
        
        $pratica['data_sinistro'] = format_date(\Carbon\Carbon::parse($pratica['data_sinistro']));
        $str = "Lettera di intervento";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetFont('Times', 'U', 11);
        $f->Write($lineh, $str);

        $str = "La presente in nome e per conto del nostro assistito ({$cliente['cognome']} {$cliente['nome']}) quale richiesta di";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetFont('Times', '', 11);
        $f->SetXY(35, $f->GetY() + 12);
        $f->Write($lineh, $str);

        $str = ["risarcimento",
                "indennizzo",
        ];
        
        $f->setX(45);
        
        foreach($str as $s) {
            $f->Rect($f->getX(), $f->getY() + 10, 3, 3);
            $f->SetXY($f->getX() + 5, $f->getY() + 8);
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->Write($lineh, $s);
            $f->SetXY($f->getX() + 60, $f->getY() - 8);
        }
        
        $str = "a seguito dell'evento sotto meglio descritto. Si informa altresì che l'assistito ha eletto domicilio pro-tempore per tutto quanto inerente il caso presso il nostro studio.";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + 15);
        $f->Write($lineh, $str);
        
        $str = "DATA {$pratica['data_sinistro']}, ORA {$pratica['ora_sinistro']}, LUOGO {$pratica['luogo_sinistro']}, AUTORITÀ {$autorita['nome']}, COMANDO DI {$pratica['comando_autorita']}, TIP. INTERVENTO {$pratica['tipologia_intervento']}, SINISTRO N. {$pratica['numero_sinistro']}, TESTIMONI {$pratica['testimoni']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + $lineh);
        $f->Write($lineh, $str);
        
        
        $str = [['',                        'DATI DI PARTE',                                'DATI DI CONTROPARTE'],
                ['ANAGRAFICA',              "{$cliente['cognome']} {$cliente['nome']}",     "{$pratica['conducente_controparte']}"],
                ['TIPO VEICOLO',            "{$pratica['veicolo_parte']}",                  "{$pratica['veicolo_controparte']}"],
                ['N. POLIZZA',              "{$pratica['numero_polizza_parte']}",           "{$pratica['numero_polizza_controparte']}"],
                ['ASSICURAZIONE',           "{$pratica['assicurazione_parte']}",            "{$pratica['assicurazione_controparte']}"],
                ['TARGA',                   "{$pratica['targa_parte']}",                    "{$pratica['targa_controparte']}"],
        ];
        
        $f->Ln();
        $f->SetY($f->GetY() + 4);

        foreach($str as $i => $row) {
            $rowY = $f->GetY();
            $maxY = $rowY;
            
            $f->SetXY(20, $rowY);
            $s = $row[0];
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->SetFont('Times', 'B', 11);
            $f->MultiCell(40, $lineh, $s);
            if ($f->GetY() > $maxY) $maxY = $f->GetY();
            
            $f->SetXY(60, $rowY);
            $s = $row[1];
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->SetFont('Times', $i ? '' : 'B', 11);
            $f->MultiCell(60, $lineh, $s);
            if ($f->GetY() > $maxY) $maxY = $f->GetY();
            
            $f->SetXY(125, $rowY);
            $s = $row[2];
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->SetFont('Times', $i ? '' : 'B', 11);
            $f->MultiCell(60, $lineh, $s);
            if ($f->GetY() > $maxY) $maxY = $f->GetY();
            
            $f->setY($maxY);
        }
        
        $str = "DINAMICA ";
        $f->SetFont('Times', 'B', 11);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + $lineh);
        $f->Write($lineh, $str);
        
        $str = "{$pratica['dinamica_sinistro']}";
        $f->SetFont('Times', '', 11);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetX(60);
        $f->Write($lineh, $str);
        
        $str = "MEZZO VISIBILE ";
        $f->SetFont('Times', 'B', 11);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + $lineh);
        $f->Write($lineh, $str);
        
        $str = "{$pratica['mezzo_visibile']}";
        $f->SetFont('Times', '', 11);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetX(60);
        $f->Write($lineh, $str);
        
        $str = "I dati contenuti nella presente lettera di intervento sono esaustivi a quanto le attuali normative di legge richiedono, tuttavia possono essere integrati, variati, modificati a seconda di nuove informazioni che dovessero pervenire alla scrivente società. I dati vengono forniti sotto il più stretto riservo e dovranno essere utilizzati dal destinatario esclusivamente nell’ottica della gestione della vertenza.";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + 10);
        $f->Write($lineh, $str);
        
        
        $str = "{$cliente['cognome']} {$cliente['nome']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(40, $f->GetY() + 12);
        $f->Write($lineh, $str);
        
        $str = "Studio di consulenza";
        $f->SetXY(120, $f->GetY());
        $f->Write($lineh, $str);
        
        
        $str = "ALL.";
        $f->SetXY(20, $f->GetY() + 30);
        $f->Write($lineh, $str);
        
        $f->Rect($f->GetX() + 4, $f->GetY() - 1, 100, 7);
        

        $f->Output();
        
    }
}