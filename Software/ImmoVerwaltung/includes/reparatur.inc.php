<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

session_start();
if(isset($_POST['reparatur_submit'])){
    
    require 'dbh.inc.php';
    
    
    $text = $_POST['text'];
    $file = "../uploads/".basename($_FILES['image']['name']);
    
    $image = $_FILES['image']['name'];
    
    if(move_uploaded_file($_FILES['image']['tmp_name'], $file)){
        $msg = "Success";
    }
        
        $sql_empfaenger = "SELECT benutzer.BenutzerID,benutzer.Strasse,benutzer.Ort,benutzer.PLZ,benutzer.Hausnr,benutzer.Name, benutzer.Vorname FROM benutzer JOIN mietverhaeltnis ON benutzer.BenutzerID=mietverhaeltnis.Vermieter WHERE mietverhaeltnis.Mieter=?";
        $sql = "SELECT * FROM benutzer WHERE BenutzerID=?;";
        $sql_insert_message = "INSERT INTO nachrichten(SenderID,EmpfaengerID,Text,Datei) VALUES(?,?,?,?);";
        
        $stmt_empfaenger = mysqli_stmt_init($conn);
        $stmt = mysqli_stmt_init($conn);
        
        
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../reparatur.php?error=sqlerror");
            exit();
        }else{
            
            $id = $_SESSION['sessionid'];
            
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if($row=mysqli_fetch_assoc($result)){
                
                $vorname = $row['Vorname'];
                $nachname = $row['Name'];
                $strasse = $row['Strasse'];
                $ort = $row['Ort'];
                $plz = $row['PLZ'];
                $hausnummer = $row['Hausnr'];
            }
            
        }
        
        if(!mysqli_stmt_prepare($stmt_empfaenger,$sql_empfaenger)){
            header("Location: ../reparatur.php?error=sqlerror");
            exit();
        }else{
        
            $id = $_SESSION['sessionid'];
            
            //mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_bind_param($stmt_empfaenger, "i", $id);
            
            //mysqli_stmt_execute($stmt);
            mysqli_stmt_execute($stmt_empfaenger);
            
            //$result = mysqli_stmt_get_result($stmt);
            $result_empfaenger = mysqli_stmt_get_result($stmt_empfaenger);
            
            
            //if(($row=mysqli_fetch_assoc($result))){
                
                //$vorname = $row['Vorname'];
                //$nachname = $row['Name'];
                
            if($row2=mysqli_fetch_assoc($result_empfaenger)){
                
                $empfaenger_vorname = $row2['Vorname'];
                $empfaenger_nachname = $row2['Name'];
                $empfaenger_ort = $row2['Ort'];
                $empfaenger_strasse = $row2['Strasse'];
                $empfaenger_plz = $row2['PLZ'];
                $empfaenger_hausnummer = $row2['Hausnr'];
                $empfaenger_id = $row2['BenutzerID'];
            }
        
        require './pdf_templates/basic_pdf/pdf_start.php';
                
        
        $pdf->Cell(10,10,"Beschwerde/Reparatur",0,0);
        $pdf->Ln(10);
        
        require './pdf_templates/basic_pdf/pdf_header.php';
       
        require './pdf_templates/basic_pdf/pdf_icon.php';
        
        
        
        $topic="Beschreibung:";
        
        require './pdf_templates/basic_pdf/topic.php';

        require './pdf_templates/basic_pdf/pdf_freitext.php';
       
        require './pdf_templates/basic_pdf/pdf_mfg.php';
        
        require './pdf_templates/basic_pdf/pdf_anhang.php';
        
        require './pdf_templates/basic_pdf/pdf_image.php';
        
        //require './pdf_templates/basic_pdf/pdf_ende.php';
            
        $sql_msg = "INSERT INTO nachrichten(SenderID,EmpfaengerID,Text,Datei) VALUES(?,?,?,?)";
        $stmt_msg = mysqli_stmt_init($conn);
        
        if (mysqli_stmt_prepare($stmt_msg, $sql_msg)) {
            //echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            
            
            $content = $pdf->Output("S");
            
            $gruese = "Reparatur/Beschwerdeformular ".$nachname;
            
            mysqli_stmt_bind_param($stmt_msg, "iiss", $id,$empfaenger_id,$gruese,$content);
            
            mysqli_stmt_execute($stmt_msg);
            //require './pdf_templates/basic_pdf/pdf_ende.php';
            header("Location: ../reparatur.php?success");
        }else{
        header("Location: ../reparatur.php?errormsg");
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
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
