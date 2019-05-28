<?php

session_start();
if(isset($_POST['gruesse_submit'])){
   
    
    require 'dbh.inc.php';
    
    
    $text = $_POST['text'];
   
    
    
    foreach( $_POST['empfaenger'] as $value) {
        $pieces = explode(" ", $value);
        $empfaenger_vorname = $pieces[1];
        $empfaenger_nachname = $pieces[0];
    
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(empty($text)){
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
                
                
                require './pdf_templates/basic_pdf/pdf_start.php';

                require './pdf_templates/basic_pdf/pdf_header.php';
                
                require './pdf_templates/basic_pdf/pdf_icon.php';
                
                require './pdf_templates/basic_pdf/pdf_anrede.php';
   
                require './pdf_templates/basic_pdf/pdf_freitext.php';

                require './pdf_templates/basic_pdf/pdf_mfg.php';

                require './pdf_templates/basic_pdf/pdf_ende.php';
                
            
                
            }else{
                header("Location: ../gruesse.php?error=error");
                exit();
            }
        }
    }
    }
}