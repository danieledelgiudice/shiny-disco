<?php

namespace App\Lettere;

class GenericaGenerator
{
    const REQUIRES = '1';
    const NAME = "Generica";

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
        $f->SetFont('Times', '', 11);
        $f->AddPage();

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

        $str = "Livorno " . format_date(\Carbon\Carbon::today()) . "\n n.p. " . $pratica['numero_pratica'];
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
        $nominativo_caps = strtoupper("{$cliente['cognome']} {$cliente['nome']}");
        $str = "SINISTRO N {$pratica['numero_sinistro']} DEL {$pratica['data_sinistro']} NS ASSISTITO {$nominativo_caps}";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetFont('Times', 'U', 11);
        $f->Write($lineh, $str);

        $str = "In riferimento al sinistro in oggetto Vi comunichiamo che:";
        $f->SetFont('Times', '', 11);
        $f->SetXY(35, $f->GetY() + 12);
        $f->Write($lineh, $str);

        $str = ["L’importo di € ____________________ da Voi inviatoci  viene accettato a solo titolo di acconto sul maggior danno subito.",
                "Alleghiamo alla presente originali di fatture per prestazioni mediche effettuate dal nostro assistito.",
                "Alleghiamo alla presente perizia medico legale e rimaniamo in attesa degli estremi del Vostro medico fiduciario di zona. ",
                "L’importo di € __________________ da Voi proposto è stato ritenuto congruo dal Nostro assistito con l’arrivo della somma concordata il sinistro si intenderà definito e transatto. ",
                "In allegato alla presente inviamo testimonianze di persone/a  presenti/e al fatto storico.",
                "In allegato inviamo copia documenti testimoni/e.",
                "Nonostante numerosi tentativi non riusciamo a metterci in contatto con Voi, Vi preghiamo volerci chiamare telefonicamente per informazioni relative al sinistro di cui all’oggetto.",
        ];

        foreach($str as $s) {
            $f->Rect(20, $f->getY() + 10, 3, 3);
            $f->SetXY(25, $f->getY() + 8);
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->Write($lineh, $s);
        }

        $f->SetY($f->GetY() + 8);

        $f->Rect(20, $f->GetY() + 2, 3, 3);

        $f->Rect(30, $f->GetY() + 2, 160, 35);

        $str = "Valga la presente anche quale interruzione dei termini di prescrizione previsti dalla legge
Ci è gradita l’occasione per porgere cordiali saluti.
All";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + 40);
        $f->Write($lineh, $str);

        $f->Rect(30, $f->GetY(), 160, 8);

        $str = "Studio di consulenza";
        $f->SetXY(100, $f->GetY() + 15);
        $f->Write($lineh, $str);

        return $f->Output($this::NAME.'.pdf', 'I');
    }
}
