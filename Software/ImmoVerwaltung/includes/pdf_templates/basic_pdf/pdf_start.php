<?php

require 'dbh.inc.php';
require "../lib/fpdf181/fpdf.php";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("times","",16);