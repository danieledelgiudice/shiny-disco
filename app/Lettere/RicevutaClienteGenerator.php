<?php

namespace App\Lettere;

class RicevutaClienteGenerator
{
    const REQUIRES = '1';
    const NAME = "Ricevuta cliente";

    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $professione = $data['professione'];

        $lineh = 7;

        // $template = iconv('UTF-8', 'windows-1252', $template);

        $f = new \fpdf\FPDF();
        $f->SetTitle($this::NAME);
        $f->SetMargins(20, 20);
        $f->AddPage();
        $f->SetFont('Times', '', 11);

        $logo = $data['logo'];
        $logo_url = \URL::asset("/images/logos/$logo");
        
        $f->Image($logo_url, 20, 15, 45);

        $str = "P.zza Attias 37, 4° piano - 57100 Livorno
Tel 0586/941901 0586/895118 Linee 5 a ricerca automatica
Fax 0586 1730113
Resp. Uffici esterni 0586 1734753
";
    
        switch($logo) {
            case 'elisir.png':
                $str = $str . "elisirinfortunistica@pec.it
daniela.burini@elisirinfortunistica.it
Partita IVA 01682480494";
                break;
            case 'elys.jpg':
                $str = $str . "
Partita IVA 01724020498";
                break;
        }

        $f->SetXY(80, 15);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);

        $str = "Livorno " . format_date(\Carbon\Carbon::today()) . "\n n.p. " .  $pratica['numero_pratica'];
        $f->SetXY(20, 60);
        $f->MultiCell(0, $lineh, $str);

        $str = "Egr. {$cliente['cognome']} {$cliente['nome']}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(105, 70);
        $f->Cell(0, $lineh, $str);

        $str = "OGGETTO: ";
        $f->SetFont('Times', 'B', 11);
        $f->SetXY(20, 85);
        $f->Write($lineh, $str);

        $pratica['data_sinistro'] = format_date(\Carbon\Carbon::parse($pratica['data_sinistro']));
        $nominativo_caps = strtoupper("{$cliente['cognome']} {$cliente['nome']}");
        $str = "SINISTRO N {$pratica['numero_sinistro']} DEL {$pratica['data_sinistro']} NS ASSISTITO {$nominativo_caps}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetFont('Times', 'U', 11);
        $f->Write($lineh, $str);

        $str = "In riferimento al sinistro in oggetto a sottoscritta società dichiara di aver ricevuto l’importo";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetFont('Times', '', 11);
        $f->SetXY(35, $f->GetY() + 12);
        $f->Write($lineh, $str);

        $str = ["di € ____________________ a titolo di pagamento delle prestazioni mediche effettuate",
                "di € ____________________ a titolo di onorari",
        ];

        foreach($str as $s) {
            $f->Rect(20, $f->getY() + 10, 3, 3);
            $f->SetXY(25, $f->getY() + 8);
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->Write($lineh, $s);
        }



        $str = "L'assistito ha quindi ";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(35, $f->GetY() + 10);
        $f->Write($lineh, $str);


        $str = ["definitivamente",
                "parzialmente",
        ];

        foreach($str as $s) {
            $f->Rect(20, $f->getY() + 10, 3, 3);
            $f->SetXY(25, $f->getY() + 8);
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->Write($lineh, $s);
        }

        $f->SetY($f->GetY() + 10);

        $str = "assolto quanto dovuto sempre in riferimento al sinistro di cui all'oggetto.";
        $str = iconv('UTF-8', 'windows-1252', $str);
        // $f->SetXY(20, $f->GetY() + 40);
        $f->Write($lineh, $str);

        $str = "Studio di consulenza";
        $f->SetXY(100, $f->GetY() + 15);
        $f->Write($lineh, $str);

        return $f->Output($this::NAME.'.pdf', 'I');

    }
}
