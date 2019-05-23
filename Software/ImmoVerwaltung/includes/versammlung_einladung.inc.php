<?php

session_start();
if(isset($_POST['versammlung_einladung_submit'])){
   
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $datum = $_POST['datum'];
    $uhrzeit = $_POST['uhrzeit'];
    $ort= $_POST['Ort'];
    $text = $_POST['text'];
    
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(!empty($datum)&& !empty($uhrzeit)&& !empty($ort) && !empty($text)){
                
                
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10,10,"",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Strasse Versender",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Stadt Versender",0,0);
                
                $pdf->Ln(10);
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10,10,"",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Strasse Empfaenger",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Stadt Empfaenger",0,0);
                
                $pdf->Ln(5);
                $pdf->Cell(10,10,"________________________________________________________________________________",0,0);
                
                $pdf->Ln(10);
                $pdf->SetFont("Arial","B",14);
                $pdf->MultiCell(0, 10,"Einladung zur Eigentuemerversammlung am ".$datum." der Wohnungseigentuemergemeinschaft Objektadresse");
                $pdf->Ln(5);
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10, 10, "Sehr geehrte/r Frau/Herr ,");
                $pdf->Ln(15);
                $pdf->SetFont("Arial","",12);
                $pdf->MultiCell(0, 5,"zur diesjaehrigen ordentlichen Wohnungseigentuemerversammlung der Wohnungseigentuemergemeinschaft Objektadresse laden wir sie hiermit ein.");
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Datum: ".$datum);
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Zeit: ".$uhrzeit." Uhr");
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Ort: ".$ort);
                $pdf->Ln(20);
                $pdf->MultiCell(0, 10,$text,1);
                $pdf->Ln(20);
                $pdf->Cell(10, 10, "Mit freundlichen Gruessen");
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Hausverwaltung ");
                $pdf->Ln(15);
                $pdf->Cell(10, 10, "Anlagen: ");
                $pdf->Output();
    }else{
        header("Location: ../versammlung_einladung.php?error=emptyfields");
        exit();
    }
            
                
}else{
header("Location: ../versammlung_einladung.php?error=error");
exit();
}


