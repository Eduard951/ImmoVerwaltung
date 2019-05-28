<?php

session_start();
if(isset($_POST['versammlung_einladung_submit'])){
   
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $datum = $_POST['datum'];
    $uhrzeit = $_POST['uhrzeit'];
    $ort= $_POST['Ort'];
    $text = $_POST['text'];
    $tagesordnung= $_POST['tagesordnung'];
    $punkte = explode(",", $tagesordnung);
    $datum_update = explode("-",$datum);
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(!empty($datum)&& !empty($uhrzeit)&& !empty($ort) && !empty($text)){
        
        $sql = "SELECT * FROM benutzer WHERE BenutzerID=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }else{
            $id = $_SESSION['sessionid'];
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result)){
                
                $vorname = $row['Vorname'];
                $nachname = $row['Name'];
                
                
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10,10,"Hausverwaltung ".$nachname,0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Telefon: 000",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Strasse Verwaltung",0,0);
                $pdf->Image("../images/icon.png",150,10,50,50);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Stadt Verwaltung",0,0);
                
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
                $pdf->SetFont("Arial","B",13);
                $pdf->MultiCell(0, 10,"Einladung zur Eigentuemerversammlung am ".$datum_update[2].".".$datum_update[1].".".$datum_update[0]." der Wohnungseigentuemergemeinschaft Objektadresse");
                $pdf->Ln(5);
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10, 10, "Sehr geehrte/r Frau/Herr ,");
                $pdf->Ln(15);
                $pdf->SetFont("Arial","",12);
                $pdf->MultiCell(0, 5,"zur diesjaehrigen ordentlichen Wohnungseigentuemerversammlung der Wohnungseigentuemergemeinschaft Objektadresse laden wir sie hiermit ein.");
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Datum: ".$datum_update[2].".".$datum_update[1].".".$datum_update[0]);
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Zeit: ".$uhrzeit." Uhr");
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Ort: ".$ort);
                $pdf->Ln(20);
                $pdf->MultiCell(0, 10,$text,1);
                $pdf->Ln(20);
                $pdf->SetFont("Arial","B",12);
                $pdf->Cell(0, 10,"Tagesordnung:");
                $pdf->Ln(5);
                $pdf->SetFont("Arial","",12);
                
                if(!empty($tagesordnung)){
                for($i=0; $i<count($punkte);$i++){
                $j=$i+1;
                $pdf->Ln(5);
                $pdf->Cell(0, 10,"TOP ".$j." : ".$punkte[$i]);
                }
                }
                
                $pdf->Ln(20);
                $pdf->Cell(10, 10, "Mit freundlichen Gruessen");
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Hausverwaltung ");
                $pdf->Ln(15);
                $pdf->Cell(10, 10, "Anlagen: ");
                $pdf->Output();
                
                
    }else{
        header("Location: ../versammlung_einladung.php?error=sqlerror");
        exit();
    }
        }
                
}else{
header("Location: ../versammlung_einladung.php?error=emeptyfieldserror");
exit();
}

}

