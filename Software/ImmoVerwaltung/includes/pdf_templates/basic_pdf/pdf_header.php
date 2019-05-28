<?php

$pdf->SetFont("times","",12);
$pdf->Cell(10,10,$nachname,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$vorname,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Strasse Versender",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Stadt Versender",0,0);

$pdf->Ln(10);
$pdf->SetFont("times","",12);
$pdf->Cell(10,10,$empfaenger_nachname,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$empfaenger_vorname,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Strasse Empfaenger",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Stadt Empfaenger",0,0);

$pdf->Ln(5);
$pdf->Cell(10,10,"________________________________________________________________________________",0,0);
