<?php

$pdf->SetFont("times","",12);
$pdf->Cell(10,10,"Mit freundlichen Gruessen ",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,$vorname." ".$nachname,0,0);
$pdf->Ln(10);