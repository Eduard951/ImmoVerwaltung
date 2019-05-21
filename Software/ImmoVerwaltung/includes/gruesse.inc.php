<?php

session_start();
if(isset($_POST['gruesse_submit'])){
   
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $text = $_POST['text'];
    $ende = $_POST['ende'];
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(empty($text) || empty($ende)){
        header("Location: ../gruesse.php?error=emptyfields");
        exit();
    }else{
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
                $pdf->Cell(10,10,$nachname,0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,$vorname,0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Strasse Versender",0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Stadt Versender",0,0);
                
                $pdf->Ln(10);
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10,10,"Nachname Empfaenger",0,0);
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
                $pdf->MultiCell(0,10,$text, 1);
                
                $pdf->Ln(25);
                $pdf->SetFont("Arial","",12);
                $pdf->Cell(10,10,"Mit freundlichen Gruessen",0,0);
                $pdf->Ln(10);
                $pdf->MultiCell(0,10,$ende,0);
                $pdf->Output();
            
                
            }else{
                header("Location: ../gruesse.php?error=error");
                exit();
            }
        }
    }
}