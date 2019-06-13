<?php

session_start();
if(isset($_POST['protokoll_submit'])){
    require 'dbh.inc.php';
    $beginn =$_POST['beginn'];
    $ort =$_POST['ort'];
    $ende =$_POST['ende'];
    $leiter =$_POST['leiter'];
    $protokollfuehrer =$_POST['protokollfuehrer'];
    $vwb=$_POST['verwaltungsbeirat'];
    $freitext= $_POST['freitext'];
    $personen=$_POST['personen_bfk'];
    $anteil=$_POST['anteil'];
    $stimmenanteile=$_POST['stimmenanteile'];
    $text_bfk=$_POST['text_bfk'];
    $beschluss=$_POST['beschluss'];
    $abstimmungstyp=$_POST['abstimmungstyp'];
    $beschlussregel= $_POST['beschlussregel'];
    $ja= $_POST['ja'];
    $nein= $_POST['nein'];
    $enthalten= $_POST['enthaltungen'];
    $beschlusstext= $_POST['beschluss_text'];
    $anwesend= $_POST['anwesend'];
    $gesamt= $_POST['stimmenanteile_gesamt'];
    
   
    
    /*
     $sql_insert_header="INSERT INTO ev_protokoll_header(VerwalterID,Ort,Jahr,Startzeit,Endzeit) VALUES(?,?,?,?,?);";
     $stmt_insert_header = mysqli_stmt_init($conn);
    
     if(!mysqli_stmt_prepare($stmt_insert_header,$sql)){
     header("Location: versammlung_einladung.php?error=sqlerror");
     exit();
     }else{
     $noch_unklar = "noch unklar";
     mysqli_stmt_bind_param($stmt_insert_header, "issss", $id,$ort,$datum_update[0],$uhrzeit,$noch_unklar);
     mysqli_stmt_execute($stmt);
     }
     */
    
    $sql_verwalter_attribute = "SELECT * FROM verwalter JOIN benutzer ON verwalter.BenutzerID=benutzer.BenutzerID WHERE verwalter.BenutzerID=?";
    
    $stmt_verwalter_attr = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt_verwalter_attr, $sql_verwalter_attribute)){
        header("Location: ../versammlung_einladung.php?error=sqlerror");
        exit();
    }else{
        
        mysqli_stmt_bind_param($stmt_verwalter_attr, "i", $_SESSION['sessionid']);
        
        mysqli_stmt_execute($stmt_verwalter_attr);
        
        $result_verwalter = mysqli_stmt_get_result($stmt_verwalter_attr);
        
        if($row_verw=mysqli_fetch_assoc($result_verwalter)){
            
            $verw_name = $row_verw['Name'];
            $verw_vorname = $row_verw['Vorname'];
            
            
            require_once "../lib/fpdf181/fpdf.php";
            
            $pdf = new FPDF();
            
            $pdf->AddPage();
            $pdf->SetFont("times","",14);
            $pdf->Cell(10,10,"Eigentuemerversammlung ",0,0);
            $pdf->Ln(10);
            $pdf->SetFont("times","B",12);
            $pdf->MultiCell(0,10,"Protokoll der Wohnungseigentuemerversammlung  der Wohnungseigentuemergemeinschaft Musterstr. 78, 38294 Musterstadt");
            $pdf->Ln(5);
            $pdf->SetFont("times","",12);
            $pdf->Cell(10,10,"Beginn: ".$beginn,0,0);
            $pdf->Ln(5);
            $pdf->Cell(10,10,"Ort: ".$ort,0,0);
            $pdf->Ln(5);
            $pdf->Cell(10,10,"Ende: ".$ende,0,0);
            $pdf->Ln(5);
            $pdf->Cell(10,10,"Leiter: ".$leiter,0,0);
            $pdf->Ln(5);
            $pdf->Cell(10,10,"Protokollfuehrer: ".$verw_name." ".$verw_vorname,0,0);
            $pdf->Ln(5);
            $pdf->Cell(10,10,"Verwaltungsbeirat: ".$vwb,0,0);
            $pdf->Ln(10);
            
            
                $pdf->Ln(5);
                $pdf->SetFont("times","B",14);
               
                    
                    
                        
                        $pdf->Cell(0, 10,"TOP "."1");
                        $pdf->Ln(10);
                        $pdf->SetFont("times","",12);
                        $pdf->MultiCell(0, 10,$freitext,1);
                        $pdf->Ln(10);
                        
                        $w = array(50, 45, 45, 45);
                        $spalten=["Wohnungsnr./Beschreibung Eigentuemer","Anteil","Anwesend","Stimmenanteile"];
                        
                        $pdf->SetFont("times","B",14);
                        $pdf->Cell(10,10,"TOP".": "."Beschlussfaehigkeit der Versammlung",0,0);
                        $pdf->Ln(10);
                        $pdf->SetFont("times","",8);
                    
                        for($k=0;$k<count($spalten);$k++){
                            $pdf->Cell($w[$k],7,$spalten[$k],1,0,'C');
                        }
                        $pdf->Ln();
                        
                        for($v=0;$v<count($personen);$v++){
                            
                            $tausend = 1000.0;
                            $pdf->Cell($w[0],7,$personen[$v],1,0);
                            $pdf->Cell($w[1],7,($tausend*$anteil[$v]),1,0);
                            $pdf->Cell($w[2],7,$anwesend[$v],1,0);
                            $pdf->Cell($w[3],7,$stimmenanteile[$v],1,0);
                            $pdf->Ln();
                        }
                        
                        
                        
                        $pdf->SetFont("times","I",8);
                        $pdf->Cell($w[0],7,"Summe:",1,0,"R");
                        $pdf->Cell($w[1],7,"1000",1,0,"L");
                        $pdf->Cell($w[2],7,"",1,0,"L");
                        $pdf->Cell($w[3],7,$gesamt,1,0,"L");
                        
                        
                        $pdf->Ln(10);
                        $pdf->SetFont("times","",12);
                        $pdf->MultiCell(0,10,$text_bfk,1);
                        
                        //$beschr_eigentuemer_label= "Wohnungsnr./Beschreibung";
                        //$eigentuemer_label = "eigentuemer";
                        //$anteil_label = "Anteil";
                        //$anwesend_label ="Anwesend";
                        //$stimmenanteile_label= "Stimmenanteile";
                        
                        $pdf->Ln(10);
                        
                        $width = array(45, 45, 45, 45);
                        $height = array(15,7,7,15);
                        $header=["Beschluss", "Abstimmung", "Beschlussregel","Abstimmungsergebnis"];
                        
                        $pdf->SetFont("times","B",14);
                        $pdf->Cell(10,10,"TOP"."3".": "."Verwaltungsberat",0,0);
                        $pdf->Ln(10);
                        $pdf->SetFont("times","",12);
                        
                        for($y=0;$y<count($header);$y++){
                            $pdf->Cell($width[$y],$height[$y],$header[$y],1,0,'C');
                            if($y==0){
                                $pdf->MultiCell(145,$height[$y],$beschluss,1);
                            }else if($y==1){
                                $pdf->MultiCell(145,$height[$y],$abstimmungstyp,1);
                            }else if($y==2){
                                $pdf->MultiCell(145,$height[$y],$beschlussregel,1);
                            }else if($y==3){
                                $pdf->MultiCell(145,$height[$y],"Ja:".$ja." Nein:".$nein." Enthalten".$enthalten,1);
                            }
                            //$pdf->Ln();
                        }
                        $pdf->Ln(5);
                        $pdf->SetFont("times","",12);
                        $pdf->MultiCell(0,10,$beschlusstext,1);
                        
                        
                        $pdf->Ln(20);
                        
                    

                $pdf->Ln(15);
            
            
            $pdf-> Cell(10,10,"_________________                                     _________________");
            $pdf->ln(5);
            $pdf-> Cell(10,10,"Ort/Datum                                                      Protokollfuehrer");
            $pdf->ln(15);
            $pdf-> Cell(10,10,"_________________");
            $pdf->ln(5);
            $pdf->Cell(10,10,"Verwalter");
            $pdf->Ln(15);
            $pdf-> Cell(10,10,"_________________                                     _________________");
            $pdf->ln(5);
            $pdf-> Cell(10,10,"Eigentuemer 1                                                Eigentuemer 2");
            $pdf->ln(10);
            //$pdf->Output();
            
            $sql_besitzer_verwaltungseinheit = "SELECT DISTINCT benutzer.BenutzerID,benutzer.PLZ,benutzer.Ort,benutzer.Strasse,benutzer.Hausnr,benutzer.Name,benutzer.Vorname,verwaltungseinheit.Kommentar,verwaltungseinheit.VS_Eigentumsanteil FROM benutzer JOIN verwaltungseinheit ON benutzer.BenutzerID=verwaltungseinheit.Besitzer WHERE verwaltungseinheit.ObjektID=?";
            $sql_vermieter_verwaltungseinheit = "SELECT DISTINCT benutzer.BenutzerID,benutzer.PLZ,benutzer.Ort,benutzer.Strasse,benutzer.Hausnr,benutzer.Name,benutzer.Vorname,verwaltungseinheit.Kommentar,verwaltungseinheit.VS_Eigentumsanteil FROM benutzer JOIN mietverhaeltnis ON benutzer.BenutzerID=mietverhaeltnis.Vermieter JOIN verwaltungseinheit ON verwaltungseinheit.VerwID=mietverhaeltnis.VerwID WHERE verwaltungseinheit.VerwID=?";
            $sql_hausobjekt = "SELECT verwaltungseinheit.ObjektID FROM verwaltungseinheit WHERE VerwID=?";
            $sql_VEs= "SELECT verwaltungseinheit.VerwID FROM verwaltungseinheit JOIN hausobjekt ON hausobjekt.ObjektID=verwaltungseinheit.ObjektID WHERE verwaltungseinheit.ObjektID=?";
            $stmt_hausobjekt= mysqli_stmt_init($conn);
            $stmt_besitzer = mysqli_stmt_init($conn);
            $stmt_vermieter = mysqli_stmt_init($conn);
            $stmt_VEs = mysqli_stmt_init($conn);
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
                        $besitzer_kommentar=$row_besitzer['Kommentar']." "."Besitzer";
                        $besitzer_plz=$row_besitzer['PLZ'];
                        $besitzer_ort=$row_besitzer['Ort'];
                        $besitzer_strasse=$row_besitzer['Strasse'];
                        $besitzer_nr=$row_besitzer['Hausnr'];
                        $besitzer_id=$row_besitzer['BenutzerID'];
                        $besitzer_anteil = $row_besitzer['VS_Eigentumsanteil'];
                        
                        $emp= array($besitzer_nachname,$besitzer_vorname,$besitzer_kommentar,$besitzer_plz,$besitzer_ort,$besitzer_strasse,$besitzer_nr,$besitzer_id,$besitzer_anteil);
                        
                        $empfaenger = array($emp);
                        
                        //$empfaenger = array($emp);
                    }
                }
            }
            
            
            //VEs loop
            if(!mysqli_stmt_prepare($stmt_VEs, $sql_VEs)){
                header("Location: ../versammlung_einladung.php?error=sqlerror_besitzer");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt_VEs, "i", $iddd);
                
                mysqli_stmt_execute($stmt_VEs);
                
                $result_VEs = mysqli_stmt_get_result($stmt_VEs);
                
                if(!empty($result_VEs)){
                    while($row_Ves = $result_VEs->fetch_assoc()){
                        $ve_id = $row_Ves['VerwID'];
                        
                        
                        //vermieter in array pushen
                        if(!mysqli_stmt_prepare($stmt_vermieter, $sql_vermieter_verwaltungseinheit)){
                            header("Location: ../versammlung_einladung.php?error=sqlerror_vermieter");
                            exit();
                        }else{
                            mysqli_stmt_bind_param($stmt_vermieter, "i", $ve_id);
                            
                            mysqli_stmt_execute($stmt_vermieter);
                            
                            $result_vermieter = mysqli_stmt_get_result($stmt_vermieter);
                            
                            if(!empty($result_vermieter)){
                                while($row_vermieter = $result_vermieter->fetch_assoc()){
                                    
                                    $vermieter_nachname=$row_vermieter['Name'];
                                    $vermieter_vorname=$row_vermieter['Vorname'];
                                    $vermieter_kommentar=$row_vermieter['Kommentar']." "."Vermieter";
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
                        
                    }
                }
            }
            for($t=0;$t<count($empfaenger);$t++){
                $sql_msg = "INSERT INTO nachrichten(SenderID,EmpfaengerID,Text,Datei) VALUES(?,?,?,?)";
                $stmt_test = mysqli_stmt_init($conn);
                
                if(mysqli_stmt_prepare($stmt_test, $sql_msg)){
                    
                    $content = $pdf->Output("S");
                    
                    $gruese = "Abschlussprotokoll";
                    //$l=1001;
                    
                    mysqli_stmt_bind_param($stmt_test, "iiss", $_SESSION['sessionid'],$empfaenger[$t][7],$gruese,$content);
                    
                    mysqli_stmt_execute($stmt_test);
                    //require './pdf_templates/basic_pdf/pdf_ende.php';
                    
                    header("Location: ../gruesse.php?success");
                }else{
                    header("Location: ../gruesse.php?errormsg");
                }
            }
            
        }
    }
    
    
}
