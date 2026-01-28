<?php

namespace App\Lettere;

class FatturaGenerator
{
    const NAME = "Fattura";

    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $fattura = $data['fattura'];

        $lineh = 7;

        // $template = iconv('UTF-8', 'windows-1252', $template);

        $f = new \fpdf\FPDF();
        $f->SetTitle($this::NAME);
        $f->SetMargins(20, 20);
        $f->AddPage();

        if ($fattura['appartenenza'] == 1) {

            // Ely's
            $logo_url = \URL::asset("/images/logos/elys.jpg");
            $str = "Ely's consulenze
Via Cogorano 25, 5° piano - 57123 Livorno
Tel 0586/941901 0586/895118 Linee 5 a ricerca automatica
Fax 0586 1730113 Resp. Uffici esterni 0586 1734753
Partita IVA 01724020498";

        } else if ($fattura['appartenenza'] == 2) {

            // Elisir
            $logo_url = \URL::asset("/images/logos/elisir.png");
            $str = "Studio di consulenza Elisir
Via Cogorano 25, 5° piano - 57123 Livorno
Tel 0586/941901 0586/895118 Linee 5 a ricerca automatica
Fax 0586 1730113
Resp. Uffici esterni 0586 1734753
Partita IVA 01682480494
elisirinfortunistica@pec.it    daniela.burini@elisirinfortunistica.it";

        } else if ($fattura['appartenenza'] == 3) {

            // Group
            $logo_url = \URL::asset("/images/logos/group.jpg");
            $str = "Ely's Elisir Group SRL
Via Cogorano 25, 5° piano - 57123 Livorno
P.I. 01868050491
C.F. 01868050491
Iscritta alla Camera di Commercio di Livorno n. LI-20276
Capitale Sociale € 10.000,00";

        }

        // $f->Rect(20, 15, 45, 34);
        $f->Image($logo_url, 20, 15, 45);

        $f->SetFont('Times', '', 11);
        $f->SetXY(80, 10);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);


        $data_fattura = format_date(\Carbon\Carbon::parse($fattura['data_emissione']));
        $f->SetFont('Times', 'B', 11);
        $str = "Data:
Numero fattura:
Cognome e nome:
Codice fiscale:
Indirizzo:
";
        $f->SetXY(20, 70);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);

        $f->SetFont('Times', '', 11);
        $str = "{$data_fattura}
{$fattura['numero']}
{$cliente['cognome']} {$cliente['nome']}
{$cliente['codice_fiscale']}
{$cliente['via']}, {$cliente['citta_residenza']}, {$cliente['provincia']}
";
        $f->SetXY(60, 70);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh, $str);


        $str = "Dettaglio prestazione:";
        $f->SetFont('Times', 'B', 11);
        $f->SetXY(20, $f->GetY() + 12);
        $f->Write($lineh, $str);

        $str = "{$fattura['dettaglio_prestazione']}";
        $f->SetFont('Times', '', 11);
        $f->SetX(60);
        $f->Write($lineh, $str);

        $netto = $fattura['importo_netto'] + 0;
        $iva = $netto * 0.22;
        $lordo_competenze = $netto + $iva;
        $esente = $fattura['importo_esente'] + 0;
        $lordo_incassato = $lordo_competenze + $esente;

        $netto_h = format_money($netto);
        $iva_h = format_money($iva);
        $lordo_competenze_h = format_money($lordo_competenze);
        $esente_h = format_money($esente);
        $lordo_incassato_h = format_money($lordo_incassato);


        $f->Ln();
        $f->Ln();


        $y = $f->GetY();
        $f->SetFont('Times', 'B', 11);
        $str = "Importo netto:
Iva al 22%:
Lordo competenze:
Importo esente IVA ex art. 15 dpr. 633/72:
Lordo incassato:
";
        $f->SetXY(20, $y);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(0, $lineh + 2, $str);


        $f->SetFont('Times', '', 11);
        $str = "$netto_h
$iva_h
$lordo_competenze_h
$esente_h
$lordo_incassato_h
";
        $f->SetXY(100, $y);
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->MultiCell(30, $lineh + 2, $str, 0, 'R');



        if ($fattura['appartenenza'] == 1) {

            // Ely's
            $str = "Ely's consulenza";

        } else if ($fattura['appartenenza'] == 2) {

            // Elisir
            $str = "Studio di consulenza Elisir";

        } else if ($fattura['appartenenza'] == 3) {

            // Elisir
            $str = "Ely's Elisir Group SRL";

        }

        $f->SetXY(140, $f->GetY() + 15);
        $f->Write($lineh, $str);

        return $f->Output($this::NAME.'.pdf', 'I');

    }
}
