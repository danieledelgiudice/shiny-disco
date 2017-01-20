<?php

namespace App\Lettere;

class MandatoPrivacyGenerator
{
    public function generate($data)
    {
        $pratica = $data['pratica'];
        $cliente = $data['cliente'];
        $professione = $data['professione'];
        
        $lineh = 4.5;
        
        $f = new \fpdf\FPDF();
        $f->SetMargins(20, 20);
        $f->AddPage();
        $f->SetFont('Times', '', 10);
        
        $str = "Spett.le Ely’s consulenza
Spett.le ELISIR 
Il sottoscritto  {$cliente['nome']} {$cliente['cognome']} ( {$cliente['codice_fiscale']} ) di seguito denominato mandante";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, 20);
        $f->Write($lineh, $str);
        
        $str = ["in proprio",
                "in nome e per conto del minore ___________________________ di cui esercito la potestà genitoriale",
                "in nome e conto della società/ditta ____________________________________ di cui sono legale rappresentante",
        ];
        
        foreach($str as $s) {
            $f->Rect(20, $f->getY() + 7, 3, 3);
            $f->SetXY(25, $f->getY() + 6);
            $s = iconv('UTF-8', 'windows-1252', $s);
            $f->Write($lineh, $s);
        }
        
        $str = "CON IL PRESENTE ATTO VI CONFERISCE MANDATO DISGIUNTO E /O CONGIUNTO  PER LA GESTIONE, TRATTAZIONE, DEFINIZIONE IN SEDE STRAGIUDIZALE DELL’EVENTO CHE SOTTO BREVEMENTE DESCRIVO:";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + $lineh);
        $f->Write($lineh, $str);
        
        $f->Ln();
        for ($i = 0; $i < 3; $i++) {
            $f->SetY($f->GetY() + $lineh);
            $f->Line(20, $f->GetY(), 190, $f->GetY());
        }
        
        
        
        
        $str = "Ai seguenti patti e condizioni: ";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + 2);
        $f->Write($lineh, $str);
        
        $f->Ln();
        
        $str = ["Il mandante riconosce espressamente che la mandataria non è tenuta a garantire il conseguimento dell'integrale  risarcimento o indennizzo, o comunque del raggiungimento di un accordo transattivo ritenuto soddisfacente dal mandante, derivando per la mandataria dal presente rapporto professionale una mera obbligazione di mezzi e non di risultato",
                "La mandataria, al fine di espletare l’incarico professionale ricevuto, potrà avvalersi di collaboratori, tecnici, medici ed ogni altro soggetto terzo ritenuto a propria insindacabile discrezione utile al conseguimento del risarcimento o indennizzo le prestazioni di tali soggetti saranno a totale carico del mandante ove non risarciti e/o indennizzati dalla controparte",
                "E’ comunque facoltà del mandante di servirsi di professionisti ( come quelli elencati al punto precedente ) dallo stesso scelti",
                "La mandataria espleterà ogni attività che si renderà necessaria per la definizione della presente pratica ovvero, a titolo esemplificativo, procederà all’esame ed allo studio della pratica, all’istruzione della pratica, alla ricerca dei documenti, alla ricostruzione della dinamica del sinistro ed alla ripartizione della responsabilità, alla denuncia civile del sinistro ai sensi della legge vigente, alla richiesta di accesso agli atti in possesso dell'Assicurazione o dell'Amministrazione (qualora tale attività sia ritenuta necessaria al fine perseguito), alla consulenza in ordine ad eventuali sanzioni amministrative irrogate dalle Autorità intervenute, alla redazione di ricorsi in opposizione alle eventuali sanzioni amministrative ritenute illegittimamente irrogate, alla valutazione e quantificazione di tutti i danni derivanti dal sinistro, alla eventuale definizione stragiudiziale della pratica, sia essa parziale che integrale.",
                "Per l’opera svolta il mandante riconoscerà al mandante un importo pari a quanto previsto secondo il tariffario dei compensi presentato ed accettato dalle competenti autorità e che dichiaro di conoscere de accettare",
                "In ipotesi di revoca anticipata e/o di rinuncia del mandato, il mandante corrisponderà alla mandataria le competenze professionali per l'attività sino a quel momento espletata calcolate a norma delle tariffe professionali praticate dalla mandataria di cui al precedente punto 5 oltre ad ogni spesa documentata da quest'ultima anticipata in suo nome e conto nell’espletamento dell’incarico professionale.",
                "Il mandante conferisce alla mandataria potere di rappresentanza ex artt. 1704 e 1387 ss. cod. civ., elegge domicilio pro-tempore ex art. 47 cod. civ. presso la sede legale della mandataria, ed autorizza la medesima mandataria, per il fine perseguito dal rapporto professionale instauratosi, a diffondere i suoi dati personali sensibili a terzi soggetti per quanto necessario al conseguimento dell’obiettivo del presente mandato",
                "Le parti convengono che la risoluzione di eventuali controversie che dovessero sorgere in relazione al rapporto professionale instaurato sarà devoluta alla competenza territoriale esclusiva delle Autorità Giudiziaria foro di Livorno",
                ];
        
        foreach($str as $i => $row) {
            $rowY = $f->GetY() + 1;
            
            $k = $i + 1;
            $s = "$k)";
            $f->SetXY(25, $rowY);
            $f->MultiCell(0, $lineh, $s);
            
            $row = iconv('UTF-8', 'windows-1252', $row);
            $f->SetXY(30, $rowY);
            $f->MultiCell(0, $lineh, $row);
        }
        
        
        
        $str = "Livorno ___/___/______";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + 3);
        $f->Write($lineh, $str);
        
        $str = "Firma";
        $f->SetX(120);
        $f->Write($lineh, $str);
        
        $f->Ln();
        $str = 'Il mandante versa, a titolo di fondo spese la somma di € …………………………';
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetFont('Times', 'BU', 10);
        $f->SetXY(20, $f->GetY() + 10);
        $f->Write($lineh, $str);
        
        
        $f->AddPage();
        $str = 'Informativa resa all\'interessato per il trattamento dei dati personali';
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->Cell(0, $lineh, $str, 0, 1, 'C');
        
        $f->Ln();
        
        $str = "Premesso che agli effetti del presente atto per STUDIO si intende lo studio ELY’S CONSULENZA E/O STUDIO DI CONSULENZA ELISIR CHE POSSONO OPERARE DISGIUNTAMENTE O CONGIUNTAMENTE ed a norma e per gli effetti dell’art. 13 del D.L.vo 30/06/2003 n. 196) Ai sensi dell'art.13 D. L.vo 196/2003, ed in relazione ai dati personali di cui lo STUDIO entrerà in possesso, informiamo di quanto segue:";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetFont('Times', '', 10);
        $f->Write($lineh, $str);
        
        
        
        $str = ["FINALITA' DI TRATTAMENTO DEI DATI. Il trattamento a cui saranno sottoposti i dati personali richiesti o acquisiti è diretto esclusivamente all'espletamento da parte dello STUDIO delle finalità attinenti all'esercizio dell'attività professionale di valutazione, trattazione e definizione stragiudiziale della pratica relativa al sinistro affidatoci.",
                "MODALITA' DEL TRATTAMENTO DEI DATI. Il trattamento è realizzato per mezzo delle operazioni indicate all'art. 4 comma 1 lett. a T. U.: raccolta, registrazione, organizzazione, conservazione, consultazione, elaborazione, modificazione, selezione, estrazione, raffronto, utilizzo, interconnessione, blocco, comunicazione, cancellazione e distribuzione dei dati. Le operazioni possono essere svolte con o senza l'ausilio di strumenti elettronici o comunque autorizzati. Il trattamento è svolto dal titolare e/o dagli incarichi del trattamento.",
                "CONFERIMENTO DEI DATI Il conferimento dei dati personali comuni e sensibili è strettamente necessario e si intende prestato ai fini dello svolgimento delle attività di cui al punto 1.",
                "RIFIUTO DI CONFERIMENTO DATI L'eventuale rifiuto da parte dell'interessato di conferire dati personali comuni e/o sensibili comporta l'impossibilità di una corretta esecuzione del mandato ricevuto di cui al punto 1.",
                "COMUNICAZIONE DEI DATI. I dati personali possono venire a conoscenza degli incaricati del trattamento e possono essere comunicati, per le finalità di cui al punto 1, ai soggetti interessati quali: compagnie e liquidatori di assicurazioni,periti e medici legali, società di servizi cui si affidata la gestione e/o la liquidazione della pratica, istituti di credito delegati al pagamento, banche dati esterne e tutti quei soggetti ai quali la comunicazione si rende necessaria per il corretto espletamento delle finalità di cui al punto 1 e del mandato ricevuto.",
                "DIFFUSIONE DEI DATI. I dati personali non possono essere diffusi per fini diversi dal mandato conferito",
                "TRASFERIMENTO DEI DATI ALL'ESTERO.I dati personali non possono essere trasferiti verso paesi dell'Unione Europea e verso terzi rispetto all'Unione Europea salvo che  nell'ambito delle finalità di cui al punto 1.",
                "DIRITTI DELL'INTERESSATO. L'art. 7 T.U. conferisce all'interessato l'esercizio di specifici diritti, tra cui quello di ottenere dal titolare la conferma dell'assistenza o meno di propri dati personali e la loro messa disposizione in forma intellegibile; l'interessato ha diritto di avere conoscenza dell'originale dei dati, delle finalità e delle modalità del trattamento, della logica applicata al trattamento, degli estremi identificativi del titolare e dei soggetti cui i dati possono essere comunicati; l'interessato ha inoltre diritto di ottenere l'aggiornamento, la rettificazione e l'integrazione dei dati, la cancellazione, la trasformazione in forma anonima o in blocco dei dati trattati in violazione della legge; il titolare ha il diritto di opporsi, per motivi legittimi, al trattamento dei dati.",
                "TITOLARE DEL TRATTAMENTO. Titolare e responsabile del trattamento è il sig._____________________________, RESPONSABILE  dello STUDIO", 
                "CONSENSO AL TRATTAMENTO DEI DATI PERSONALI GENERALI E SENSIBILI Preso atto dell'informativa di cui sopra e del fatto che l'invio delle informazioni personali e sanitarie, comuni e sensibili, richieste e indispensabile per poter dar corso alla pratica di sinistro, espressamente garantisco il mio consenso ai sensi degli articoli 23, 24, 25 del summenzionato D.L..vo al trattamento (inclusivo di raccolta, registrazione, organizzazione, conservazione, elaborazione, modificazione, selezione, estrazione, raffronto, utilizzo, interconnessione, blocco, comunicazione, cancellazione, distruzione) dei miei dati personali ad opera dei soggetti indicati nella predetta informativa e nei limiti di cui alla stessa. Mantengo comunque tutti i diritti previsti della legge ed in particolare il diritto di accesso, rettifica e cancellazione dei dati, ove legittimo. Per ricevuta e accettazione della comunicazione il sig./ ra_________________________________ in proprio o  ,nella qualità di amministratore della società autorizza lo STUDIO, al trattamento dei propri dati personali comuni sensibili e giudiziari.",
        ];
        
        $f->Ln();
        
        foreach($str as $i => $row) {
            $rowY = $f->GetY() + 1;
            
            $k = $i + 1;
            $s = "$k)";
            $f->SetXY(22, $rowY);
            $f->MultiCell(0, $lineh, $s);
            
            $row = iconv('UTF-8', 'windows-1252', $row);
            $f->SetXY(30, $rowY);
            $f->MultiCell(0, $lineh, $row);
        }
        
        $str = "Luogo, Data";
        $str = iconv('UTF-8', 'windows-1252', $str);
        $f->SetXY(20, $f->GetY() + 3);
        $f->Write($lineh, $str);
        
        $str = "Firma";
        $f->SetX(120);
        $f->Write($lineh, $str);
        
        $f->Output();
        
    }
}