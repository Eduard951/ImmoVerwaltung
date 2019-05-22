<?php

session_start();
if(isset($_POST['reparatur_submit'])){
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $text = $_POST['text'];
    $file = "../uploads/".basename($_FILES['image']['name']);
    
    $image = $_FILES['image']['name'];
    
    if(move_uploaded_file($_FILES['image']['tmp_name'], $file)){
        $msg = "Success";
        
        $sql_empfaenger = "SELECT Name, Vorname FROM benutzer JOIN mietverhaeltnis ON benutzer.BenutzerID=mietverhaeltnis.vermieter WHERE mietverhaeltnis.mieter=?;";
        $sql = "SELECT * FROM benutzer WHERE BenutzerID=?;";
        
        $stmt_empfaenger = mysqli_stmt_init($conn);
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../reparatur.php?error=sqlerror");
            exit();
        }
        else if(!mysqli_stmt_prepare($stmt_empfaenger,$sql_empfaenger)){
            header("Location: ../reparatur.php?error=sqlerror");
            exit();
        }else{
        
            $id = $_SESSION['sessionid'];
            
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_bind_param($stmt_empfaenger, "i", $id);
            
            mysqli_stmt_execute($stmt);
            mysqli_stmt_execute($stmt_empfaenger);
            
            $result = mysqli_stmt_get_result($stmt);
            $result_empfaenger = mysqli_stmt_get_result($stmt_empfaenger);
            
            
            if(($row=mysqli_fetch_assoc($result)) && ($row2=mysqli_fetch_assoc($result_empfaenger))){
                
                $vorname = $row['Vorname'];
                $nachname = $row['Name'];
                
                $vorname_empfaenger = $row2['Vorname'];
                $nachname_empfaenger = $row2['Name'];
        
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
        $pdf->Cell(10,10,$nachname_empfaenger,0,0);
        $pdf->Ln(5);
        $pdf->Cell(10,10,$vorname_empfaenger,0,0);
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Strasse Empfaenger",0,0);
        $pdf->Ln(5);
        $pdf->Cell(10,10,"Stadt Empfaenger",0,0);
        
        $pdf->Ln(5);
        $pdf->Cell(10,10,"________________________________________________________________________________",0,0);
        
        
        
        
        $pdf->AddPage();
        $pdf->Cell(10,10,"Anhang: ",0,0);
        $pdf->Ln(20);
        $pdf->Image($file);
        
        $pdf->Output();
            }
            
        }
            
    }
    
   // $fileName = $_FILES['file']['name']; 
    //$fileTmpName = $_FILES['file']['tmp_name'];
   // $fileSize = $_FILES['file']['size'];
   // $fileError = $_FILES['file']['error'];
   // $fileType = $_FILES['file']['type'];
    
   // $fileExt = explode('.', $fileName);
   // $fileActualExt = strtolower(end($fileExt));
    
    //$allowed = array('jpg', 'jpeg','png', 'pdf');
    
   // if(in_array($fileActualExt, $allowed)){
    //    if($fileError == 0){
    //        if($fileSize < 1000000){
                
                //INSERT befehl hier rein
                
                
                
     //       }else{
     //           echo "Datei zu gross";
    //        }
    //    }else{
   //         echo "Fehler"; 
   //     }
  //  }else{
  //      echo "Datentyp nicht unterstuetzt";
  //  }   
}