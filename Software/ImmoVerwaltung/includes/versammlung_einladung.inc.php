<?php

session_start();
if(isset($_POST['versammlung_einladung_submit'])){
   
    
    require 'dbh.inc.php';
    require "../lib/fpdf181/fpdf.php";
    
    $datum = $_POST['datum'];
    $uhrzeit = $_POST['uhrzeit'];
    $ort= $_POST['Ort'];
    $text = $_POST['text'];
    $datum_update = explode("-",$datum);
    $jahr = $datum_update[0];
    $info = $_POST['info'];
    $toptypes = $_POST['top_type']; 
    $topnames= $_POST['topnames'];
    
    //gucken, ob variablen leer sind, wenn ja dann emptyfield error
    if(!empty($datum)&& !empty($uhrzeit)&& !empty($ort) && !empty($text)){
        
        $sql_insert_versammlung = "INSERT INTO eigen_vers(ObjektID,Datum)VALUES (?,?);";
        $sql_insert_header = "INSERT INTO ev_protokoll_header(VerwalterID,Ort,Jahr,Startzeit,Endzeit,Protokoll_ID)VALUES((SELECT VerwalterID FROM verwalter WHERE BenutzerID=?),?,?,?,?,(SELECT ev_protokoll.Protokoll_ID FROM ev_protokoll JOIN eigen_vers ON ev_protokoll.VersammlungID=eigen_vers.VersammlungID WHERE eigen_vers.ObjektID=?));";
        $sql_insert_protokoll="INSERT INTO ev_protokoll(VersammlungID) VALUES((SELECT VersammlungID FROM eigen_vers WHERE eigen_vers.ObjektID=? AND eigen_vers.Datum=?))";
        
        $sql_empfaenger= "SELECT hausobjekt.ObjektID,hausobjekt.Besitzer AS besitzer_objekt,verwaltungseinheit.Besitzer,mietverhaeltnis.Vermieter FROM verwaltungseinheit JOIN mietverhaeltnis ON verwaltungseinheit.VerwID=mietverhaeltnis.VerwID JOIN hausobjekt ON verwaltungseinheit.ObjektID=hausobjekt.ObjektID WHERE verwaltungseinheit.VerwID = ?";
        $sql_hausobjekt = "SELECT verwaltungseinheit.ObjektID FROM verwaltungseinheit WHERE VerwID=?";
        $sql_eigentuemergemeinschaft = "SELECT * FROM verwaltungseinheit JOIN hausobjekt ON verwaltungseinheit.ObjektID=hausobjekt.ObjektID WHERE VerwID=?";
        $sql = "SELECT * FROM verwalter JOIN firma ON verwalter.FirmaID=firma.FirmaID WHERE BenutzerID=?;";
        
        //eingeladen
        $sql_besitzer_verwaltungseinheit = "SELECT benutzer.BenutzerID,benutzer.PLZ,benutzer.Ort,benutzer.Strasse,benutzer.Hausnr,benutzer.Name,benutzer.Vorname,verwaltungseinheit.Kommentar,verwaltungseinheit.VS_Eigentumsanteil FROM benutzer JOIN verwaltungseinheit ON benutzer.BenutzerID=verwaltungseinheit.Besitzer WHERE verwaltungseinheit.ObjektID=?";
        $sql_vermieter_verwaltungseinheit = "SELECT benutzer.BenutzerID,benutzer.PLZ,benutzer.Ort,benutzer.Strasse,benutzer.Hausnr,benutzer.Name,benutzer.Vorname,verwaltungseinheit.Kommentar,verwaltungseinheit.VS_Eigentumsanteil FROM benutzer JOIN mietverhaeltnis ON benutzer.BenutzerID=mietverhaeltnis.Vermieter JOIN verwaltungseinheit ON verwaltungseinheit.VerwID=mietverhaeltnis.VerwID WHERE verwaltungseinheit.VerwID=?";
        
        
        $stmt_hausobjekt= mysqli_stmt_init($conn);
        $stmt_insert_versammlung = mysqli_stmt_init($conn);
        $stmt_insert_header = mysqli_stmt_init($conn);
        $stmt_insert_protokoll = mysqli_stmt_init($conn);
        
        $stmt_emp= mysqli_stmt_init($conn);
        
        $stmt = mysqli_stmt_init($conn);
        $stmt_gemeinschaft = mysqli_stmt_init($conn);
        
        $stmt_besitzer = mysqli_stmt_init($conn);
        $stmt_vermieter = mysqli_stmt_init($conn);
        
        //hausobjekt herausfinden aus VerwID und in $iddd speichern
        if(!mysqli_stmt_prepare($stmt_hausobjekt, $sql_hausobjekt)){
            header("Location: ../versammlung_einladung.php?error=sqlerrorversammlung");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt_hausobjekt,"i",$_SESSION['objektid']);
            mysqli_stmt_execute($stmt_hausobjekt);
            $result_hausobjekt = mysqli_stmt_get_result($stmt_hausobjekt);
            if($roww = mysqli_fetch_assoc($result_hausobjekt)){
                $iddd= $roww['ObjektID'];
            }
                
        }
        //////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////
        
        //versammlung insert
        
        if(!mysqli_stmt_prepare($stmt_insert_versammlung, $sql_insert_versammlung)){
            header("Location: ../index.php?error=sqlerrorversammlung");
            exit();
        }else{    
                mysqli_stmt_bind_param($stmt_insert_versammlung,"is",$iddd,$datum);
                mysqli_stmt_execute($stmt_insert_versammlung);  
        }
        
        
        //insert protokoll
        if(!mysqli_stmt_prepare($stmt_insert_protokoll, $sql_insert_protokoll)){
            header("Location: ../versammlung_einladung.php?error=sqlerrorprotokoll");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt_insert_protokoll,"is",$iddd,$datum);
            mysqli_stmt_execute($stmt_insert_protokoll);
        }
        
        //header insert
        
        if(!mysqli_stmt_prepare($stmt_insert_header, $sql_insert_header)){
            header("Location: ../versammlung_einladung.php?error=sqlerrorheader");
            exit();
        }else{
            $unklar = "noch unklar";
            mysqli_stmt_bind_param($stmt_insert_header,"issssi",$_SESSION['sessionid'],$ort,$datum_update[0],$uhrzeit,$unklar,$iddd);
            mysqli_stmt_execute($stmt_insert_header);
        }
        
        //////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////
        
        
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }else{
            $id = $_SESSION['sessionid'];
            //$objektid = $_SESSION['objektid'];
            //mysqli_stmt_bind_param($stmt_gemeinschaft, "i", $objektid);
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            //mysqli_stmt_execute($stmt_gemeinschaft);
            mysqli_stmt_execute($stmt);
            
            //$result_2 = mysqli_stmt_get_result($stmt_gemeinschaft);
            $result_1 = mysqli_stmt_get_result($stmt);
            
            
            if($row=mysqli_fetch_assoc($result_1)){
                
                
                $name = $row['Name'];
                $telefon = $row['Telefon'];
                $fax = $row['Fax'];
                $strasse = $row['Strasse'];
                $hausnr = $row['Hausnr'];
                $stadt = $row['Ort'];
                $plz = $row['PLZ'];
            }
        }
        
        
        if(!mysqli_stmt_prepare($stmt_gemeinschaft, $sql_eigentuemergemeinschaft)){
            header("Location: ../index.php?error=sqlerror_prepare");
            exit();
        }else{
            
            $objektid = $_SESSION['objektid'];
            mysqli_stmt_bind_param($stmt_gemeinschaft, "i", $objektid);
            
            mysqli_stmt_execute($stmt_gemeinschaft);
            
            $result_2 = mysqli_stmt_get_result($stmt_gemeinschaft);
            
            if($row2=mysqli_fetch_assoc($result_2)){
                
                $objekt_strasse=$row2['Strasse'];
                $objekt_plz=$row2['PLZ'];
                $objekt_ort=$row2['Ort'];
                $objekt_nr=$row2['Hausnr'];
                
            }
        }
        //besitzer in array pushen
        if(!mysqli_stmt_prepare($stmt_besitzer, $sql_besitzer_verwaltungseinheit)){
            header("Location: ../versammlung_einladung.php?error=sqlerror_besitzer");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt_besitzer, "i", $iddd);
            
            mysqli_stmt_execute($stmt_besitzer);
            
            $result_besitzer = mysqli_stmt_get_result($stmt_besitzer);
            
            if(!empty($result_besitzer)){
                while($row_besitzer = $result_besitzer->fetch_assoc()){
                    
                    $besitzer_nachname=$row_besitzer['Name'];
                    $besitzer_vorname=$row_besitzer['Vorname'];
                    $besitzer_kommentar=$row_besitzer['Kommentar'];
                    $besitzer_plz=$row_besitzer['PLZ'];
                    $besitzer_ort=$row_besitzer['Ort'];
                    $besitzer_strasse=$row_besitzer['Strasse'];
                    $besitzer_nr=$row_besitzer['Hausnr'];
                    $besitzer_id=$row_besitzer['BenutzerID'];
                    $besitzer_anteil = $row_besitzer['VS_Eigentumsanteil'];
                    
                    $emp = array($besitzer_nachname,$besitzer_vorname,$besitzer_kommentar,$besitzer_plz,$besitzer_ort,$besitzer_strasse,$besitzer_nr,$besitzer_id,$besitzer_anteil);
                    
                    $empfaenger = array($emp);
                }
            }
        }
        
        //vermieter in array pushen
        if(!mysqli_stmt_prepare($stmt_vermieter, $sql_vermieter_verwaltungseinheit)){
            header("Location: ../versammlung_einladung.php?error=sqlerror_vermieter");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt_vermieter, "i", $_SESSION['objektid']);
            
            mysqli_stmt_execute($stmt_vermieter);
            
            $result_vermieter = mysqli_stmt_get_result($stmt_vermieter);
            
            if(!empty($result_vermieter)){
                while($row_vermieter = $result_vermieter->fetch_assoc()){
                    
                    $vermieter_nachname=$row_vermieter['Name'];
                    $vermieter_vorname=$row_vermieter['Vorname'];
                    $vermieter_kommentar=$row_vermieter['Kommentar'];
                    $vermieter_plz=$row_vermieter['PLZ'];
                    $vermieter_ort=$row_vermieter['Ort'];
                    $vermieter_strasse=$row_vermieter['Strasse'];
                    $vermieter_nr=$row_vermieter['Hausnr'];
                    $vermieter_id=$row_vermieter['BenutzerID'];
                    $vermieter_anteil = $row_vermieter['VS_Eigentumsanteil'];
                    
                    $emp2 = array($vermieter_nachname,$vermieter_vorname,$vermieter_kommentar,$vermieter_plz,$vermieter_ort,$vermieter_strasse,$vermieter_nr,$vermieter_id,$vermieter_anteil);
                    
                    array_push($empfaenger,$emp2);
                }
            }
        }
                    
                    for($t=0;$t<count($empfaenger);$t++){
                
                        $emp_vorname=$empfaenger[$t][0];
                        $emp_nachname=$empfaenger[$t][1];
                        $emp_kommentar=$empfaenger[$t][2];
                        $emp_strasse=$empfaenger[$t][3];
                        $emp_hausnr=$empfaenger[$t][4];
                        $emp_plz=$empfaenger[$t][5];
                        $emp_ort=$empfaenger[$t][6];
                                
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont("times","",12);
                
                
                
                $pdf->Cell(10,10,$name,0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Telefon: ".$row['Telefon'],0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,"Fax: ".$fax,0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,$strasse." ".$hausnr,0,0);
                $pdf->Image("../images/icon.png",150,10,50,50);
                $pdf->Ln(5);
                $pdf->Cell(10,10,$plz." ".$stadt,0,0);
                
                $pdf->Ln(10);
                $pdf->SetFont("times","",12);
                $pdf->Cell(10,10,$emp_vorname,0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,$emp_nachname,0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,$emp_strasse." ".$emp_hausnr,0,0);
                $pdf->Ln(5);
                $pdf->Cell(10,10,$emp_plz." ".$emp_ort,0,0);
                
                $pdf->Ln(5);
                $pdf->Cell(10,10,"________________________________________________________________________________",0,0);
                
                $pdf->Ln(10);
                $pdf->SetFont("times","B",13);
                $pdf->MultiCell(0, 10,"Einladung zur Eigentuemerversammlung am ".$datum_update[2].".".$datum_update[1].".".$datum_update[0]." der Wohnungseigentuemergemeinschaft ".$objekt_plz." ".$objekt_ort." ".$objekt_strasse." ".$objekt_nr);
                $pdf->Ln(5);
                $pdf->SetFont("times","",12);
                $pdf->Cell(10, 10, "Sehr geehrte/r Frau/Herr ".$emp_nachname.",");
                $pdf->Ln(15);
                $pdf->SetFont("times","",12);
                $pdf->MultiCell(0, 5,"zur diesjaehrigen ordentlichen Wohnungseigentuemerversammlung der Wohnungseigentuemergemeinschaft ".$objekt_plz." ".$objekt_ort." ".$objekt_strasse." ".$objekt_nr." laden wir sie hiermit ein.");
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Datum: ".$datum_update[2].".".$datum_update[1].".".$datum_update[0]);
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Zeit: ".$uhrzeit." Uhr");
                $pdf->Ln(5);
                $pdf->Cell(10, 10, "Ort: ".$ort);
                $pdf->Ln(20);
                $pdf->MultiCell(0, 10,$text,1);
                $pdf->Ln(20);
                $pdf->SetFont("times","B",12);
                $pdf->Cell(0, 10,"Tagesordnung:");
                $pdf->Ln(5);
                $pdf->SetFont("times","",12);
                
                if(!empty($topnames)){
                for($i=0; $i<count($topnames);$i++){
                $j=$i+1;
                $pdf->Ln(5);
                $pdf->Cell(0, 10,"TOP ".$j." : ".$topnames[$i]);
                }
                }
                
                $pdf->Ln(20);
                $pdf->Cell(10, 10, "Mit freundlichen Gruessen");
                $pdf->Ln(5);
                $pdf->Cell(10, 10,$name);
                $pdf->Ln(15);
                $pdf->Cell(10, 10, "Anlagen: ");
                
                if(!empty($info[0])){
                    $pdf->Ln(10);
                    $pdf->Cell(10, 10, "*Vorab-Protokoll");
                    $pdf->Ln(10);
                    $pdf->Cell(10, 10, "*Vollmachtserklaerung");
                   
                    require 'vollmacht.php';
                    require '../versammlung_vorabptotokoll.php';
                    //$pdf->Output();
                   
                    $sql_msg = "INSERT INTO nachrichten(SenderID,EmpfaengerID,Text,Datei) VALUES(?,?,?,?)";
                    $stmt_test = mysqli_stmt_init($conn);
                    
                    if(mysqli_stmt_prepare($stmt_test, $sql_msg)){
                        
                        $content = $pdf->Output("S");
                        
                        $gruese = "Einladung Versammlung";
                        //$l=1001;
                        
                        mysqli_stmt_bind_param($stmt_test, "iiss", $_SESSION['sessionid'],$empfaenger[$t][7],$gruese,$content);
                        
                        mysqli_stmt_execute($stmt_test);
                        //require './pdf_templates/basic_pdf/pdf_ende.php';
                        
                        header("Location: ../versammlung_einladung.php?success");
                    }else{
                        header("Location: ../versammlung_einladung.php?errormsg");
                    }
                   
                }else{
                    
                    
                    
                    
                    
                    $pdf->Output();
                }

                
                                    
                                
                            }
                        
                    
        
    
            
        
        
        

                
}else{
header("Location: ../versammlung_einladung.php?error=emeptyfieldserror");
exit();
}

}
?>
