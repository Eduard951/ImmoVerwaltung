<?php

session_start();
if(isset($_POST['kuendigung_bestaetigt_submit'])){
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $datum_kuendigung = $_POST['kuendigungs_datum'];
    $datum_nutzungsende = $_POST['nutzungsende_datum'];
      
    foreach( $_POST['empfaenger'] as $value) {
        $pieces = explode(" ", $value);
        $empfaenger_nachname = $pieces[0];
        $empfaenger_vorname = $pieces[1];
        $empfaenger_strasse = $pieces[2];
        $empfaenger_hausnr = $pieces[3];
        $empfaenger_plz = $pieces[4];
        $empfaenger_ort = $pieces[5];
        $empfaenger_id = $pieces[6];
       
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
                    
                    $sender_vorname = $row['Vorname'];
                    $sender_nachname = $row['Name'];
                    $sender_strasse = $row['Strasse'];
                    $sender_nr = $row['Hausnr'];
                    $sender_plz = $row['PLZ'];
                    $sender_ort = $row['Ort'];
        
                    $pdf = new FPDF();
                    $pdf->AddPage();
                    $pdf->SetFont("times","U",6);
                    $pdf->Cell(14);
                    $pdf->Cell(10,10,"$sender_vorname $sender_nachname, $sender_strasse $sender_nr, $sender_plz $sender_ort",0,0);
                    $pdf->Ln(4);
                    $pdf->SetFont("times","",9);
                    $pdf->Cell(14);
                    $pdf->Cell(10,10,"$empfaenger_vorname $empfaenger_nachname",0,0);
                    $pdf->Ln(4);
                    $pdf->Cell(14);
                    $pdf->Cell(10,10,"$empfaenger_strasse $empfaenger_hausnr",0,0);
                    $pdf->Ln(4);
                    $pdf->Cell(14);
                    $pdf->Cell(10,10,"$empfaenger_plz $empfaenger_ort",0,0);
                    $pdf->Ln(36);
                    $pdf->SetFont("times","B",9);
                    $pdf->Cell(14);
                    $pdf->Cell(10,10,"Ihre Kuendigung des Mietverhaeltnisses zum $datum_nutzungsende",0,0);
                    $pdf->Ln(20);
                    $pdf->SetFont("times","",9);
                    $pdf->Cell(14);
                    $pdf->Cell(10,10,"Sehr geehrte/r Frau/Herr $empfaenger_nachname,",0,0);
                    $pdf->Ln(12);
                    $pdf->Cell(14);
                    $pdf->MultiCell(0,4,"hiermit bestaetige ich Ihre Kuendigung des Wohnraummietvertrages der Wohnung in $empfaenger_strasse $empfaenger_hausnr, $empfaenger_plz $empfaenger_ort vom $datum_kuendigung fristgerecht zum $datum_nutzungsende.", 0,"L",false);
                    $pdf->Ln(4);
                    $pdf->Cell(14);
                    $pdf->MultiCell(0,4,"Ich bitte Sie sich nach dem Auszug zu melden, damit bei einer Begehung ein abschliessendes Uebergabeprotokoll erstellt und die Schluesseluebergabe geregelt werden kann.", 0,"L",false);
                    $pdf->Ln(12);
                    $pdf->Cell(14);
                    $pdf->Cell(10,10,"Mit freundlichen Gruessen,",0,0);
                    $pdf->Ln(4);
                    $pdf->Cell(14);
                    $pdf->Cell(10,10,"$sender_vorname $sender_nachname",0,0);

                    //PDF an Mieter verschicken   
                    $sql_msg = "INSERT INTO nachrichten(SenderID, EmpfaengerID, Text, Datei) VALUES(?, ?, ?, ?)";
                    
                    if(mysqli_stmt_prepare($stmt, $sql_msg)){
                        
                        $content = $pdf->Output("S");
                        $kb = "Kuendigungsbestaetigung Vermieter"." ".$sender_nachname;

                        mysqli_stmt_bind_param($stmt, "iiss", $id, $empfaenger_id, $kb, $content);
                        mysqli_stmt_execute($stmt);
                      
                        header("Location: ../kuendigung_bestaetigung.php?success");
                    }else{
                        header("Location: ../kuendigung_bestaetigung.php?errormsg");
                        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                    }
                          
                }else{
                    header("Location: ../kuendigung_bestaetigung.php?error=error");
                    exit();
                }
            }
        }
    }
