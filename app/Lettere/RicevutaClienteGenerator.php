<?php

namespace App\Lettere;

class RicevutaClienteGenerator
{
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
        
        $logo_elisir = $data['logo'];
        $logo_url = public_path() . "/images/logos/$logo_elisir";
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

        $f->Output();
        
    }
}