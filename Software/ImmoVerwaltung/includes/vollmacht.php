<?php
session_start();

require 'dbh.inc.php';
require "../lib/fpdf181/fpdf.php";

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
        $pdf->Cell(10,10,"An: ");
        $pdf->Ln(10);
        $pdf->Cell(10,10,"Hausverwaltung ".$nachname,0,0);
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Telefon: 000",0,0);
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Strasse Verwaltung",0,0);
        $pdf->Image("../images/icon.png",150,5,40,40);
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Stadt Verwaltung",0,0);
        $pdf->Ln(10);
        $pdf->SetFont("Arial","B",12);
        $pdf->MultiCell(0,10,"Vollmacht zur Eigentuemerversammlung 2019 
        der 
        Wohnungseigentuemergemeinschaft Musterstr. 78, 38294 Musterstadt",0,"C");
        $pdf->SetFont("Arial","",12);
        $pdf->Ln(10);
        $pdf->Cell(10,10,"Hiermit uebertrage(n) ich/wir:");
        $pdf->Ln(10);
        $pdf->Cell(10,10,$vorname." ".$nachname);
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Strasse");
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Plz und Ort");
        
        $pdf->Ln(15);
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(10,10,"Meine/Unsere Vollmacht zur Versammlung am 'Datum'");
        $pdf->Ln(10);
        $pdf->Cell(10,10,"o an Herrn/Frau_______________________________");
        $pdf->Ln(6);
        $pdf->Cell(10,10,"o an den Versammlungsleiter");
        $pdf->Ln(15);
        $pdf->MultiCell(0,5,"o Ich/Wir ermaechtige(n) die/den Bevollmaechtigte(n) saemtliche Abstimmungen vorbehaltlos nach ihrem/seinem Ermessen vorzunehmen.");
        
        $pdf->Ln(10);
        $pdf->Cell(10,10,"Diese Vollmacht ist nicht uebertragbar, eine Unterbevollmaechtigung ist erlaubt.");
        $pdf->Ln(8);
        $pdf->MultiCell(0, 10,"Bitte beachten Sie auch Vorgaben zur Bevollmaechtigung, die ggf. in Teilungserklaerungen notiert sind.");
        
        $pdf->Ln(15);
        $pdf->Cell(10,10,"________________________");
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Ort, Datum");
        
        $pdf->Output();
        
    }
}