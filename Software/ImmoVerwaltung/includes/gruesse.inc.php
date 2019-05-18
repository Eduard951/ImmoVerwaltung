<?php

if(isset($_POST['gruesse_submit'])){
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $text = $_POST['text'];
    $ende = $_POST['ende'];

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
    
    
    
    $pdf->Ln(15);
    $pdf->SetFont("Arial","B",16);
    $pdf->Cell(10,10,"Sehr geehrte/r Frau/Herr XYZ,",0,0); 
    $pdf->Ln(12);
    $pdf->SetFont("Arial","",14);
    $pdf->Cell(10,10,$text,0,0);
    
    $pdf->Ln(25);
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(10,10,"Mit freundlichen Gruessen",0,0); 
    $pdf->Ln(10);
    $pdf->Cell(10,10,$ende,0,0);
    $pdf->Output();
    
}