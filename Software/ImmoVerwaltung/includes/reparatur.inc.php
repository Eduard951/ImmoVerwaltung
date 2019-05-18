<?php

if(isset($_POST['reparatur_submit'])){
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $text = $_POST['text'];
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name']; 
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg', 'jpeg','png', 'pdf');
    
    if(in_array($fileActualExt, $allowed)){
        if($fileError == 0){
            if($fileSize < 1000000){
                
                $pdf = new FPDF();
                $pdf->AddPage();
                
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10,10,"Name Versender",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Vorname Versender",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Strasse Versender",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Stadt Versender",0,0);
                
                $pdf->Ln(10);
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10,10,"Name Empfaenger",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Vorname Empfaenger",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Strasse Empfaenger",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Stadt Empfaenger",0,0);
                
                $pdf->Ln(5);
                $pdf->Cell(10,10,"________________________________________________________________________________",0,0);
                
                $pdf->Ln(25);
                $pdf->SetFont("Arial","B",16);
                $pdf->Cell(10,10,"Reparatur/Beschwerde: ",0,0);
                $pdf->Ln(12);
                $pdf->SetFont("Arial","",14);
                $pdf->Cell(10,10,$text,0,0);
                $pdf->Image($file);
                $pdf->Output();
                
            }else{
                echo "Datei zu gross";
            }
        }else{
            echo "Fehler"; 
        }
    }else{
        echo "Datentyp nicht unterstuetzt";
    }
    
    
    
}