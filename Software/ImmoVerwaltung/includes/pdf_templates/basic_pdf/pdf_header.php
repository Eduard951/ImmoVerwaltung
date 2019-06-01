<?php

$pdf->SetFont("times","",12);
$pdf->Cell(10,10,$nachname,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$vorname,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$strasse." ".$hausnummer,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$plz." ".$ort,0,0);

$pdf->Ln(10);
$pdf->SetFont("times","",12);
$pdf->Cell(10,10,$empfaenger_nachname,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$empfaenger_vorname,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$empfaenger_strasse." ".$empfaenger_hausnummer,0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$empfaenger_plz." ".$empfaenger_ort,0,0);

$pdf->Ln(5);
$pdf->Cell(10,10,"________________________________________________________________________________",0,0);

