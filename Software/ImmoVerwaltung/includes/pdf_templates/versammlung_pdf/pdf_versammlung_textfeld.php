<?php

$pdf->SetFont("times","B",16);
$pdf->Cell(10,10,"TOP".$nummer.": ".$ueberschrift,0,0);
$pdf->Ln(10);
$pdf->SetFont("times","",14);
$pdf->MultiCell(0,10,$text, 1);
$pdf->Ln(25);
