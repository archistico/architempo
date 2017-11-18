<?php
require 'config.php';
require 'vendor/fpdf/fpdf.php';

class FatturaPdf {
    public static function Stampa($numero, $anno, $data, $logo, $studio, $studio_proprieta,
                                  $studioindirizzo, $studiorecapiti, $studiofiscali,
                                  $denominazione, $indirizzo, $recapiti, $datifiscali,
                                  $oggetto, $importo, 
                                  $modalita, $conto, $iban, $intestazione, $scadenza
                                  ) {

        $pdf = new FPDF('P','mm','A4');
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(false, 10);

        // Impostazioni font
        //$pdf->AddFont('Comic','I','comici.php');
        $font = 'Arial';

        // Nome file e autore
        $pdf->SetTitle("Fattura $anno - $numero");
        $pdf->SetAuthor(utf8_decode($studio));

        $pdf->AddPage();

        // Metti gli sfondi
        $pdf->SetFillColor(255,204,90);
        $pdf->Rect(0, 0, 15, 297, "F");
        $pdf->Rect(38.1, 0, 86.5-38.1, 65.1, "F");
        $pdf->Rect(30, 146.4, 165, 12, "F");
        $pdf->Rect(33, 268, 165, 2, "F");

        $pdf->SetFillColor(255,255,255);
        $pdf->Rect(30, 146.4+12, 165, 12, "F");
        $pdf->SetFillColor(232,232,232);
        $pdf->Rect(30, 146.4+12+12, 165, 12, "F");
        $pdf->SetFillColor(255,255,255);
        $pdf->Rect(30, 146.4+12+12+12, 165, 12, "F");
        $pdf->SetFillColor(232,232,232);
        $pdf->Rect(30, 146.4+12+12+12+12, 165, 12, "F");
        

        // LOGO
        $pdf->SetFont($font,'B',12);
        $pdf->SetXY(38,47.4);
        $pdf->Cell(48.4,10,utf8_decode(strtoupper($studio)),0,0,'C');
        $pdf->SetFont($font,'',10);
        $pdf->SetXY(38,52.9);
        $pdf->Cell(48.4,10,utf8_decode(strtoupper($studio_proprieta)),0,0,'C');
        $pdf->Image($logo, 45 ,12, 35, 30, 'PNG');

        // TESTI
        $pdf->SetFont($font,'B',48);
        $pdf->SetXY(130,30);
        $pdf->Cell(65,10,'FATTURA',0,0,'R');

        $pdf->SetTextColor(96,96,96);
        $pdf->SetFont($font,'B',14);
        $pdf->SetXY(135,47.4);
        $pdf->Cell(30,10,"NUMERO:",0,0,'R');

        $pdf->SetFont($font,'B',14);
        $pdf->SetXY(135,54.9);
        $pdf->Cell(30,10,"DATA:",0,0,'R');

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont($font,'B',14);
        $pdf->SetXY(170,47.4);
        $pdf->Cell(25,10,"$anno - $numero",0,0,'R');

        $pdf->SetFont($font,'B',14);
        $pdf->SetXY(170,54.9);
        $pdf->Cell(25,10,"$data",0,0,'R');

        $pdf->SetFont($font,'B',18);
        $pdf->SetXY(33,81);
        $pdf->Cell(162,10, utf8_decode($denominazione));

        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,92.2);
        $pdf->Cell(162,10, utf8_decode($indirizzo));

        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,98.2);
        $pdf->Cell(162,10, utf8_decode($recapiti));

        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,106.3);
        $pdf->Cell(162,10, utf8_decode($datifiscali));

        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,122.5);
        $pdf->Cell(162,10, "Oggetto:");

        $pdf->SetFont($font,'B',18);
        $pdf->SetXY(33,129.3);
        $pdf->Cell(162,10, utf8_decode($oggetto));

        $pdf->SetFont($font,'B',12);
        $pdf->SetXY(33,148);
        $pdf->Cell(118,10, "DESCRIZIONE");
        $pdf->SetXY(151,148);
        $pdf->Cell(33,10, "TOTALE", 0,0,'R');

        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,148+12);
        $pdf->Cell(118,10, "Importo");
        $pdf->SetXY(151,148+12);
        $pdf->Cell(33,10, utf8_decode(number_format($importo, 2, ',', ' '))." ".EURO, 0,0,'R');
        
        $importoconrivalsa = $importo*1.04;
        $importorivalsa = $importo*0.04;

        $pdf->SetXY(33,148+12+12);
        $pdf->Cell(118,10, "Rivalsa 4% contributo INPS");
        $pdf->SetXY(151,148+12+12);
        $pdf->Cell(33,10, utf8_decode(number_format($importorivalsa, 2, ',', ' '))." ".EURO, 0,0,'R');
        
        $importoinarcassa = $importoconrivalsa*0.04;
        $pdf->SetXY(33,148+12+12+12);
        $pdf->Cell(118,10, "Contributo integrativo 4% INARCASSA su ".utf8_decode(number_format($importoconrivalsa, 2, ',', ' '))." ".EURO);
        $pdf->SetXY(151,148+12+12+12);
        $pdf->Cell(33,10, utf8_decode(number_format($importoinarcassa, 2, ',', ' '))." ".EURO, 0,0,'R');
                                  
        $pdf->SetFont($font,'B',12);
        $pdf->SetXY(33,148+12+12+12+12);
        $pdf->Cell(118,10, "Totale da corrispondere");
        $pdf->SetXY(151,148+12+12+12+12);
        $pdf->Cell(33,10, utf8_decode(number_format($importo + $importorivalsa+ $importoinarcassa, 2, ',', ' '))." ".EURO, 0,0,'R');

        $pdf->SetFont($font,'',8);
        $pdf->SetXY(33,209);
        $pdf->Cell(162,3, utf8_decode("Prestazione svolta in regime fiscale di vantaggio ex art.1, commi 54-89, L.190/2014,"));
        $pdf->SetXY(33,209+3);
        $pdf->Cell(162,3, utf8_decode("pertanto, non soggetta a IVA né a ritenuta"));

        $pdf->SetFont($font,'B',12);
        $pdf->SetXY(33,227.3);
        $pdf->Cell(162,10,utf8_decode("Modalità di pagamento"));

        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,234.2);
        $pdf->Cell(162,10,utf8_decode($modalita." su ".$conto));
        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,234.2+5);
        $pdf->Cell(162,10,utf8_decode("IBAN: ".$iban));
        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,234.2+5+5);
        $pdf->Cell(162,10,utf8_decode("Intestato a: ".$intestazione));
        $pdf->SetFont($font,'',12);
        $pdf->SetXY(33,234.2+5+5+5);
        $pdf->Cell(162,10,utf8_decode("Rimessa Diretta a 15 gg. - scadenza il: ".$scadenza));

        $pdf->SetFont($font,'B',12);
        $pdf->SetXY(33,271.5);
        $pdf->Cell(162,5,utf8_decode($studio));
        $pdf->SetFont($font,'',10);
        $pdf->SetXY(33,271.5+5);
        $pdf->Cell(162,5,utf8_decode($studio_proprieta));

        $pdf->SetFont($font,'',10);
        $pdf->SetXY(33,271.5);
        $pdf->Cell(162,5,utf8_decode($studioindirizzo),0,0,'R');
        $pdf->SetXY(33,271.5+5);
        $pdf->Cell(162,5,utf8_decode($studiorecapiti),0,0,'R');
        $pdf->SetXY(33,271.5+5+5);
        $pdf->Cell(162,5,utf8_decode($studiofiscali),0,0,'R');

        // SEGNI PIEGATURA
        $pdf->SetFillColor(96,96,96);
        $pdf->Rect(0, 99, 5, 0.1, "F");
        $pdf->Rect(0, 99+99, 5, 0.1, "F");

        $pdf->Output();
    }
}

FatturaPdf::Stampa("000","2017","01/01/2017",
                    STUDIO_LOGO, STUDIO_DENOMINAZIONE, STUDIO_PROPRIETA,
                    STUDIO_INDIRIZZO, STUDIO_RECAPITI, STUDIO_DATI_FISCALI,
                    "Ing. Piru Piru", "Via delle rose XXIII, 10 - 11100 Sun (AO)",
                    "Telefono: 000 00 00 00 - info@piru.it", "P.IVA: 111 11 11 11 11 - C.F. XXX XXX 00X00 X000X",
                    "Consulenza 1090 - Redazione documentazione", 1350,
                    STUDIO_PAGAMENTO_MODALITA, STUDIO_PAGAMENTO_CONTO, STUDIO_PAGAMENTO_IBAN, STUDIO_PAGAMENTO_INTESTAZIONE, "01/01/2017");