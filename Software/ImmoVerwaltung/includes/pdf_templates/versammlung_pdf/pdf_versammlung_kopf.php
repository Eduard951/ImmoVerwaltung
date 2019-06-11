<?php
$pdf->SetFont("times","",16);
$pdf->Cell(10,10,"Eigentuemerversammlung ".$jahr,0,0);

$pdf->SetFont("times","B",16);

$pdf->MultiCell(0,10,"Protokoll der Wohnungseigentuemerversammlung ".$jahr." der Wohnungseigentuemergemeinschaft ".$objekt.".", 1);
$pdf->Ln(10);


$pdf->SetFont("times","",12);
$pdf->Cell(10,10,"Beginn: ".$beginn."",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Ort: ".$ort."",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Ende: ".$ende."",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Leider: ".$leiter."",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Protokollfuehrer: ".$protokollfuehrer."",0,0);
$pdf->Ln(5);
$pdf->Cell(10,10,"Verwalungsbeirat: ",0,0);
$pdf->Ln(5);

$pdf->Ln(25);