<?php

if(isset($_POST['gruesse_submit'])){
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $text = $_POST['text'];

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",16);
    $pdf->Cell(10,10,"Sehr geehrte/r Frau/Herr XYZ",0,0); 
    $pdf->Ln(12);
    $pdf->SetFont("Arial","",14);
    $pdf->Cell(10,10,$text,0,0);
    $pdf->Output();
    
}