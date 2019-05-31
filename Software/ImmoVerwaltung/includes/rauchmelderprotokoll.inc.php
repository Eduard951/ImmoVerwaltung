<?php

session_start();
if(isset($_POST['wartungsprotokoll_submit'])){
    
    
    require 'dbh.inc.php';
    //     require "../lib/fpdf181/fpdf.php";
    require('../lib/fpdf181/mc_table.php');

    
    
    foreach( $_POST['verwaltungseinheit'] as $value) {
        $pieces = explode("*", $value);
        $objekt_id = $pieces[0];
        $verw_id = $pieces[1];
        $verw_strasse = $pieces[2];
        $verw_hausnr = $pieces[3];
        $verw_plz = $pieces[4];
        $verw_ort = $pieces[5];
        $verw_kommentar = $pieces[6];
        $verw_besitzer_vorname = $pieces[7];
        $verw_besitzer_name = $pieces[8];
        
        
            $sql = "SELECT * FROM benutzer WHERE BenutzerID=?;";
            $sql2 = "SELECT Vorname, Name FROM benutzer JOIN mietverhaeltnis ON benutzer.BenutzerID = mietverhaeltnis.Mieter WHERE Vermieter = ? AND VerwID = ?";
            $sql3 = "SELECT COUNT(*) FROM zimmer WHERE VerwID = ?";
            $sql4 = "SELECT rauchmelder.Modell, rauchmelder.Installiert, zimmer.Bezeichnung FROM rauchmelder JOIN zimmer ON rauchmelder.ZimmerID = zimmer.ZimmerID WHERE VerwID = ?";
            $stmt = mysqli_stmt_init($conn);
            
            //Anzahl der Zimmer für Größe der Tabelle
            if(!mysqli_stmt_prepare($stmt, $sql2)){
                header("Location: ../index.php?error=mieter_error");
                exit();
            }else{
                $id = $_SESSION['sessionid'];
                mysqli_stmt_bind_param($stmt, "is", $id, $verw_id);
                mysqli_stmt_execute($stmt);
                $result2 = mysqli_stmt_get_result($stmt);
                if($row=mysqli_fetch_assoc($result2)){
                    
                    $mieter_vorname = $row['Vorname'];
                    $mieter_name = $row['Name'];
                }
            }
            
            if(!mysqli_stmt_prepare($stmt, $sql3)){
                header("Location: ../index.php?error=zimmercount_error");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "s", $verw_id);
                mysqli_stmt_execute($stmt);
                $result3 = mysqli_stmt_get_result($stmt);
                if($row=mysqli_fetch_assoc($result3)){
                    
                    $zimmer_count = $row['COUNT(*)'];
                }
            }
            

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../index.php?error=vermieter_error");
                exit();
            }else{
                $id = $_SESSION['sessionid'];
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row=mysqli_fetch_assoc($result)){
                    
                    $vermieter_vorname = $row['Vorname'];
                    $vermieter_name = $row['Name'];
                    
                    //PDF generieren
                    $pdf=new PDF_MC_Table();
                    $pdf->AddPage();
                    $pdf->SetFont('Times','B',14);
                    $pdf->Cell(13);
                    $pdf->Cell(10,10,"Wartungsprotokoll fuer Rauchwarnmelder",0,0);
                    $pdf->Ln(8);
          
                    //Spaltenbreiten in Array festlegen, Tabelle anlegen
                    $pdf->SetFont('Times','',9);   
                    $pdf->SetWidths(array(85,85));
                    $pdf->Cell(14);
                    $pdf->Row(array("Objektadresse", "$verw_strasse $verw_hausnr, $verw_plz $verw_ort"));
                    $pdf->Cell(14);
                    $pdf->Row(array("Eigentuemer", "$verw_besitzer_vorname $verw_besitzer_name"));
                    $pdf->Cell(14);
                    $pdf->Row(array("Wohnung", $verw_kommentar));
                    $pdf->Cell(14);
                    $pdf->Row(array("Name des Nutzers (Mieter)","$mieter_vorname $mieter_name"));
                    $pdf->Ln(4);
                    
                    //Text vor Box mit Hinweisen
                    $pdf->SetFont('times','',9);
                    $pdf->Cell(13);
                    $pdf->MultiCell(0,4,"Um die Funktionssicherheit des Feuermelders gewaehrleisten zu koennen ist entsprechend der DIN EN 14676 mindestens einmal jaehrlich eine Wartung durchzufuehren. Gehen Sie hierbei folgendermassen vor:", 0,"L",false);
                    $pdf->Ln(4);
                    
                    //Box mit Hinweisen
                    $pdf->Cell(14);
                    $pdf->MultiCell(170,4,"- Entstauben Sie bei Bedarf den Melder mit einem weichen Tuch.
- Entfernen Sie bei Bedarf Verschmutzungen mit einem feuchten Lappen. Verwenden Sie dazu keine Reinigungsmittel!
- Pruefen Sie durch Druecken des Prueftasters, ob der Rauchmelder funktionsfaehig ist. Warten Sie dazu auf die positive Rueckmeldung des Melders. Bekommen Sie keine Rueckmeldung, muss die Batterie oder ggf. der Melder getauscht werden!
- In Umgebungen mit hoeherer Staubbelastung empfiehlt es sich, die Melder oefter mit einem Tuch zu entstauben bzw. abzuwischen, nicht jedoch auszusaugen oder mit Pressluft zu reinigen.
- Beachten Sie, dass sich durch einen Mieterwechsel, Umbau oder Neueinrichtung die Eigenschaften im Gebaeude und damit auch der Wohnung veraendern. Ggf. werden dadurch zusaetzliche Wartungen bzw. zusaetzliche Reinigungen noetig.
- Beachten Sie auf jeden Fall die gegebenen Hinweise in der Bedienungsanleitung", 1,"L",false);
                    $pdf->Ln(4);
                    
                    //Tabelle mit Rauchmelderdaten der entsprechenden Zimmer
                    $pdf->SetWidths(array(20,35,25,40,35,15));
                    $pdf->SetFont('times','B',12);    
                    $pdf->Cell(14);
                    $pdf->Row(array("Ort", "Modell", "Einbaudatum", "Wartungspunkte", "Batterie", "Unterschrift"));
                    $pdf->SetFont('times','',8);
                    
                    $zc = 1; 
                    if(!mysqli_stmt_prepare($stmt, $sql4)){
                            header("Location: ../index.php?error=rauchmelder_error");
                            exit();
                    }else{
                          mysqli_stmt_bind_param($stmt, "s", $verw_id);
                          mysqli_stmt_execute($stmt);
                          $result4 = mysqli_stmt_get_result($stmt);
                          while($row=mysqli_fetch_assoc($result4)){
                                if($zc<=$zimmer_count){
                                $rm_modell = $row['Modell'];
                                $rm_installiert = $row['Installiert'];
                                $zimmer_bezeichnung = $row['Bezeichnung'];
                                
                                //Tabellen Zeilen generieren
                                $pdf->Cell(14);
                                $pdf->Row(array("$zimmer_bezeichnung", "$rm_modell", "$rm_installiert", "[] Melder entstaubt
[] Verschmutzungen entfernt
[] Melder ueber die Prueftaste geprueft", "[] Batterie ausgetauscht
Die neue Batterie ist eine ...
[] Alkaline-Batterie
[] Lithium-Batterie", ""));
                                $zc++;
                            }        
                    }    
                    }  
                    
                    //Footer mit Feldern für Datum und Unteschrift
                    $pdf->Ln(8);
                    $pdf->SetFont('times','',9);
                    $pdf->Cell(13);
                    $pdf->MultiCell(170, 4, "Hiermit bestaetige ich die ordnungsgemaesse Wartung der oben aufgefuehrten Rauchmelder. Die naechste Wartung ist gem. DIN EN 14676 in einem Jahr oder bei offensichtlichem Fehlverhalten (Batteriemeldung, ...) vorzunehmen.", 0, "L", false);
                    $pdf->Ln(10);
                    $pdf->Cell(13);
                    $pdf->Cell(10,10,"_____________________, den ____.___.20___         _______________________________",0,0);
                    $pdf->Ln(4);
                    $pdf->SetFont('times','',8);
                    $pdf->Cell(13);
                    $pdf->Cell(10,10,"Ort, Datum                                                                              Unterschrift",0,0);
                    
                    //PDF ausgeben
                    $pdf->Output();
 
                }else{
                    header("Location: ../rauchmelderprotokoll.php?error=error");
                    exit();
                }
            }
        }
    }
    
    
//     $pdf->Row(array("Schlafzimmer", "Rauchmelderix Super 201x", "28.05.2005", "[] Melder entstaubt
// [] Verschmutzungen entfernt
// [] Melder ueber die Prueftaste geprueft", "[] Batterie ausgetauscht
// Die neue Batterie ist eine ...
// [] Alkaline-Batterie
// [] Lithium-Batterie", ""));
//     $pdf->Cell(14);
//     $pdf->Row(array("Kinderzimmer", "Rauchmelderix Super 205x", "29.05.2010", "[]Melder entstaubt
// []Verschmutzungen entfernt
// []Melder ueber die Prueftaste geprueft", "[] Batterie ausgetauscht
// Die neue Batterie ist eine ...
// [] Alkaline-Batterie
// [] Lithium-Batterie", ""));
//     $pdf->Cell(14);
//     $pdf->Row(array("Flur", "Rauchmelderix Super 201x", "28.05.2005", "[]Melder entstaubt
// []Verschmutzungen entfernt
// []Melder ueber die Prueftaste geprueft", "[] Batterie ausgetauscht
// Die neue Batterie ist eine ...
// [] Alkaline-Batterie
// [] Lithium-Batterie", ""));