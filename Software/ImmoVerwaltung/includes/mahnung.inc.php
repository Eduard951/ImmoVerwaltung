<?php

session_start();


if(isset($_POST['mahnung_submit'])){
   
    
    require 'dbh.inc.php';
    
    
    $text = $_POST['text'];

    /* 
    if(!empty($_POST['empfaenger'])){
    foreach( $_POST['empfaenger'] as $value) {
        
        $pieces = explode(" ", $value);
        $empfaenger_vorname = $pieces[1];
        $empfaenger_nachname = $pieces[0];
        $empfaenger_plz = $pieces[2];
        $empfaenger_ort = $pieces[3];
        $empfaenger_strasse = $pieces[4];
        $empfaenger_hausnummer = $pieces[5];
    */
        
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(empty($text)){
        header("Location: ../mahnung.php?error=emptyfields");
        exit();
    }else{
        $sql = "SELECT * FROM benutzer WHERE BenutzerID=?;";
        $sql_insert_message = "INSERT INTO nachrichten(AnBenutzerID,Grund,Aktiv) VALUES(?,?,?);";
        
        $stmt = mysqli_stmt_init($conn);
        $stmt_insert_messages = mysqli_stmt_init($conn);
       
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../mahnung.php?error=sqlerror");
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
                $hausnummer = $row['Hausnr'];
                $ort = $row['Ort'];
                $plz = $row['PLZ'];
                    
                if(!empty($_POST['empfaenger'])){
                    foreach( $_POST['empfaenger'] as $value) {
                        
                        $pieces = explode(" ", $value);
                        $empfaenger_vorname = $pieces[1];
                        $empfaenger_nachname = $pieces[0];
                        $empfaenger_plz = $pieces[2];
                        $empfaenger_ort = $pieces[3];
                        $empfaenger_strasse = $pieces[4];
                        $empfaenger_hausnummer = $pieces[5];
                        $empfaenger_id = $pieces[6];
                
                    
                    require './pdf_templates/basic_pdf/pdf_start.php';
                    
                    require './pdf_templates/basic_pdf/pdf_header.php';
                    
                    require './pdf_templates/basic_pdf/pdf_icon.php';
                    
                    require './pdf_templates/basic_pdf/pdf_anrede.php';
                    
                    require './pdf_templates/basic_pdf/pdf_freitext.php';
                    
                    require './pdf_templates/basic_pdf/pdf_mfg.php';
                    
                   
                    
                    
                        $sql_msg = "INSERT INTO nachrichten(SenderID,EmpfaengerID,Text,Datei) VALUES(?,?,?,?)";
                        $stmt_test = mysqli_stmt_init($conn);
                        
                        if(mysqli_stmt_prepare($stmt_test, $sql_msg)){
                        
                        $content = $pdf->Output("S");
                        
						$mahnung = "Mahnung";
                        //$gruese = "Gruesse von Vermieter"." ".$nachname;
                        //$l=1001;
                        
							if (!isset($_POST['deaktivieren'])) {
						
								mysqli_stmt_bind_param($stmt_test, "iiss", $id,$empfaenger_id,$mahnung,$content);
                        
								mysqli_stmt_execute($stmt_test);
								//require './pdf_templates/basic_pdf/pdf_ende.php';
						
								$sql_mahnung = "INSERT INTO Mahnung(AnBenutzerID,Grund,Aktiv) VALUES(?,?,?)";
								$stmt_mahnung = mysqli_stmt_init($conn);
								
								mysqli_stmt_prepare($stmt_mahnung, $sql_mahnung);
						
								mysqli_stmt_bind_param($stmt_mahnung,"iiss", $empfaenger_id,$text,true);
								mysqli_stmt_execute($stmt_mahnung);
						
                        
							header("Location: ../mahnung.php?success");
							}
							else{
								$sql_update ="UPDATE mahnung SET Aktiv = false WHERE AnBenutzerID = $empfaenger_id";
								$stmt_update = mysqli_stmt_init($conn);
								mysqli_stmt_prepare($stmt_update,$sql_update);
								mysqli_stmt_execute($stmt_update);
								
							
							}
                        }else{
                            header("Location: ../mahnung.php?errormsg");
                            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                        }
                    
                    
                    
                    //require './pdf_templates/basic_pdf/pdf_ende.php';
                
                
                //gruesse();
                
            }
        }
        
        
    }
    
    
    
    }
    
    
    }

}
