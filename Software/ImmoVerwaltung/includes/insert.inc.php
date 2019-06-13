<?php

require 'dbh.inc.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php

session_start();

//Hausobjekt einfügen
if(isset($_POST['hausobjekt_submit'])){
    
    //Hochgeladene Dateien speichern und verschieben
    $uploaddir = '../uploads/';
    $ho_lageplan = $uploaddir.basename($_FILES['ho_lageplan']['name']);
    $ho_bauplan = $uploaddir.basename($_FILES['ho_bauplan']['name']);
    
    if (move_uploaded_file($_FILES['ho_lageplan']['name'], $ho_lageplan)) {
        echo "Lageplan ist valide und wurde erfolgreich hochgeladen.\n";
    }else {
        echo "Beim Hochladen der Datei ist ein Fehler ist aufgetreten.";
    }
    if (move_uploaded_file($_FILES['ho_bauplan']['name'], $ho_bauplan)) {
        echo "Bauplan ist valide und wurde erfolgreich hochgeladen.\n";
    }else {
        echo "Beim Hochladen der Datei ist ein Fehler ist aufgetreten.";
    }

    $ho_kommentar = $_POST['ho_kommentar'];
    $ho_besitzer = $_POST['ho_eigentuemer'];
    $ho_typ = $_POST['ho_typ'];
    $ho_versammlung = $_POST['ho_versammlung'];
    $ho_strasse = $_POST['ho_strasse'];
    $ho_hausnr = $_POST['ho_hausnr'];
    $ho_plz = $_POST['ho_plz'];
    $ho_ort = $_POST['ho_ort'];

    $ho_ve_kommentar = "Hauptverwaltungseinheit";
    $ho_ve_typ = "Hausobjekt";
    $null = NULL;
    
    //Adresse muss ausgefüllt sein
//     if(empty($ho_strasse) || empty($ho_hausnr) || empty($ho_plz) || empty($ho_ort)){
//         header("Location: ../add_hausobjekt.php?error=emptyfields");
//         exit();
//     }
    
//     else{
        //Hauptbefehl
        $ho_sql = "INSERT INTO hausobjekt (Kommentar, Besitzer, Typ, Lageplan, Bauplan, Versammlung, Strasse, Hausnr, PLZ, Ort) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //Hole letzte ObjektID
        $ho_sql_select ="SELECT * FROM hausobjekt ORDER BY ObjektID DESC LIMIT 1";
        //Füge zusätzlich in die Tabelle verwaltungseinheit eine übergeordnete VE ein
        $ho_sql_verw ="INSERT INTO verwaltungseinheit (ObjektID, Kommentar, Besitzer, Wohnflaeche, Typ, Bauplan, VS_Muell, VS_Aufzug, VS_Eigentumsanteil, VS_Verwaltergebuehr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_stmt_init($conn);
        
        //TODO: es kommt nie ein SQL-Error (?)
        if(!mysqli_stmt_prepare($stmt, $ho_sql)){
            header("Location: ../add_hausobjekt.php?error=sqlerror");
            exit();
            
        }else{
            //Hausobjekt einfügen, wenn Kommentarfeld leer ist und Eigentümer nicht angegeben wurde
            if(empty($ho_kommentar)){
                if(empty($ho_eigentuemer)){
                    mysqli_stmt_bind_param($stmt, "sisbbissss", $null, $null, $ho_typ, $ho_lageplan, $ho_bauplan, $ho_versammlung, $ho_strasse, $ho_hausnr, $ho_plz, $ho_ort);
                    mysqli_stmt_execute($stmt);  
                //Kommentar leer, Eigentümer ausgewählt
                }else{
                    mysqli_stmt_bind_param($stmt, "sisbbissss", $null, $ho_besitzer, $ho_typ, $ho_lageplan, $ho_bauplan, $ho_versammlung, $ho_strasse, $ho_hausnr, $ho_plz, $ho_ort);
                    mysqli_stmt_execute($stmt);
                }
                    
            }else{
                //Kommentar angegeben, Eigentümer nicht
                if(empty($ho_eigentuemer)){
                    mysqli_stmt_bind_param($stmt, "sisbbissss", $ho_kommentar, $null, $ho_typ, $ho_lageplan, $ho_bauplan, $ho_versammlung, $ho_strasse, $ho_hausnr, $ho_plz, $ho_ort);
                    mysqli_stmt_execute($stmt);  
                //Kommentar und Eigentümer angegeben
                }else{
                    mysqli_stmt_bind_param($stmt, "sisbbissss", $ho_kommentar, $ho_besitzer, $ho_typ, $ho_lageplan, $ho_bauplan, $ho_versammlung, $ho_strasse, $ho_hausnr, $ho_plz, $ho_ort);
                    mysqli_stmt_execute($stmt); 
                }
            }
            //Gerade hinzugefügte ObjektID holen
//             $result_select = mysqli_query($conn, $ho_sql_select);
//             if($row=mysqli_fetch_assoc($result_select)){  
//                     $objektID_temp = $row['ObjektID'];
//                 }
            $objektID_temp = mysqli_insert_id($conn);
                //Mit ObjektID in Verwaltungseinheit einsetzen
                if(!mysqli_stmt_prepare($stmt, $ho_sql_verw)){
                    header("Location: ../add_hausobjekt.php?error=add_ve_sqlerror");
                    exit();
                }else{
                    if(empty($ho_eigentuemer)){
                        mysqli_stmt_bind_param($stmt, "isidsbiiii", $objektID_temp, $ho_ve_kommentar, $null, $null, $ho_ve_typ, $ho_bauplan, $null, $null, $null, $null,);
                    mysqli_stmt_execute($stmt);
                    }else{
                        mysqli_stmt_bind_param($stmt, "isidsbiiii", $objektID_temp, $ho_ve_kommentar, $ho_eigentuemer, $null, $ho_ve_typ, $ho_bauplan, $null, $null, $null, $null);
                    mysqli_stmt_execute($stmt);
                    }
                }
               
            header("Location: ../add_hausobjekt.php?insert=success");
            exit();
        }
    }
// }
// ##############################################################################################################################

if(isset($_POST['verwaltungseinheit_submit'])){
      
    $uploaddir = '../uploads/';
    $ve_bauplan = $uploaddir.basename($_FILES['ve_bauplan']['name']);
    
    if(empty($ve_bauplan)){
        $ve_bauplan = NULL;
    }else{
        if (move_uploaded_file($_FILES['ve_bauplan']['name'], $ve_bauplan)) {
            echo "Bauplan ist valide und wurde erfolgreich hochgeladen.\n";
        }else{
            echo "Beim Hochladen der Datei ist ein Fehler ist aufgetreten.";
        }
    }
    
    
    $ve_objektID = $_POST['ve_hausobjekt'];
    $ve_kommentar = $_POST['ve_kommentar'];
    $ve_eigentuemer = $_POST['ve_eigentuemer'];
    $ve_typ = $_POST['ve_typ'];
    $ve_wohnflaeche = $_POST['ve_wohnflaeche'];
    $ve_muell = $_POST['ve_muell'];
    $ve_aufzug = $_POST['ve_aufzug'];
    $ve_eigentumsanteil = $_POST['ve_eigentumsanteil'];
    $ve_verwaltergebuehr = $_POST['ve_verwaltergebuehr'];
    
    $null = NULL;
    
        $ve_sql = "INSERT INTO verwaltungseinheit (ObjektID, Kommentar, Besitzer, Wohnflaeche, Typ, Bauplan, VS_Muell, VS_Aufzug, VS_Eigentumsanteil, VS_Verwaltergebuehr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $ve_sql)){
            header("Location: ../add_verwaltungseinheit.php?error=sqlerror");
            exit();
        }else{
            if(empty($ve_kommentar)){
                if(empty($ve_eigentuemer)){
                    mysqli_stmt_bind_param($stmt, "isidsbiiii", $ve_objektID, $null, $null, $ve_wohnflaeche, $ve_typ, $ve_bauplan, $ve_muell, $ve_aufzug, $ve_eigentumsanteil, $ve_verwaltergebuehr);
                mysqli_stmt_execute($stmt);
                }else{
                    mysqli_stmt_bind_param($stmt, "isidsbiiii", $ve_objektID, $null, $ve_eigentuemer, $ve_wohnflaeche, $ve_typ, $ve_bauplan, $ve_muell, $ve_aufzug, $ve_eigentumsanteil, $ve_verwaltergebuehr);
                mysqli_stmt_execute($stmt);
                }
            }else{
                if(empty($ve_eigentuemer)){
                    mysqli_stmt_bind_param($stmt, "isidsbiiii", $ve_objektID, $ve_kommentar, $null, $ve_wohnflaeche, $ve_typ, $ve_bauplan, $ve_muell, $ve_aufzug, $ve_eigentumsanteil, $ve_verwaltergebuehr);
                mysqli_stmt_execute($stmt);
                }else{
                    mysqli_stmt_bind_param($stmt, "isidsbiiii", $ve_objektID, $ve_kommentar, $ve_eigentuemer, $ve_wohnflaeche, $ve_typ, $ve_bauplan, $ve_muell, $ve_aufzug, $ve_eigentumsanteil, $ve_verwaltergebuehr);
                mysqli_stmt_execute($stmt);
                    
                }
            }
            
            
            
            header("Location: ../add_verwaltungseinheit.php?insert=success");
            exit();
            
        }
    }

// ##############################################################################################################################

    if(isset($_POST['mietverhaeltnis_submit'])){
        
        require "../lib/fpdf181/mc_table.php";
      
        $mv_verwID =  $_POST['mv_verwaltungseinheit'];
        $mv_vermieterID = $_POST['mv_vermieter'];
        $mv_mieterID = $_POST['mv_mieter'];
        $mv_beginn = $_POST['mv_beginn'];
        $mv_ende = $_POST['mv_ende'];
        $null = NULL;
        
        if(empty($mv_verwID) || empty($mv_mieterID) || empty($mv_vermieterID) || empty($mv_beginn) || empty($mv_ende)){
                header("Location: ../add_mietverhaeltnis.php?mietverhaeltnis_error=emptyfields");
                exit();
        }else{
            $mv_sql = "INSERT INTO mietverhaeltnis (VerwID, Vermieter, Mieter, Beginn, Ende) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $mv_sql)){
                header("Location: ../add_mietverhaeltnis.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "iiiss", $mv_verwID, $mv_vermieterID, $mv_mieterID, $mv_beginn, $mv_ende);
                    mysqli_stmt_execute($stmt);
            }
        }
        
        //Wohnungsgeberbescheinigung im Anschluss erstellen
        $wg_namen_sql = "SELECT Vorname, Name, Strasse, Hausnr, PLZ, Ort FROM benutzer WHERE BenutzerID = ?";
        $wg_ho_objektID_sql = "SELECT ObjektID FROM verwaltungseinheit WHERE VerwID = ?";
        $wg_ho_adresse_sql = "SELECT Strasse, Hausnr, PLZ, Ort FROM hausobjekt WHERE ObjektID = ?";
        $wg_verw_sql = "SELECT Kommentar, Besitzer FROM verwaltungseinheit WHERE VerwID = ?";

        //Namen und Adresse von Mieter und Vermieter ermitteln
        if(!mysqli_stmt_prepare($stmt, $wg_namen_sql)){
            header("Location: ../add_mietverhaeltnis.php?namen=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $mv_vermieterID);
            mysqli_stmt_execute($stmt);
            $result_vermieter = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_vermieter)){
                
                $wg_vermieter_vorname = $row['Vorname'];
                $wg_vermieter_name = $row['Name'];
                $wg_vermieter_strasse = $row['Strasse'];
                $wg_vermieter_hausnr = $row['Hausnr'];
                $wg_vermieter_plz = $row['PLZ'];
                $wg_vermieter_ort = $row['Ort'];
            }
            mysqli_stmt_bind_param($stmt, "i", $mv_mieterID);
            mysqli_stmt_execute($stmt);
            $result_mieter = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_mieter)){
                
                $wg_mieter_vorname = $row['Vorname'];
                $wg_mieter_name = $row['Name'];
                $wg_mieter_strasse = $row['Strasse'];
                $wg_mieter_hausnr = $row['Hausnr'];
                $wg_mieter_plz = $row['PLZ'];
                $wg_mieter_ort = $row['Ort'];
            }
        }
        //ObjektID holen um die Adresse holen zu können
        if(!mysqli_stmt_prepare($stmt, $wg_ho_objektID_sql)){
            header("Location: ../add_mietverhaeltnis.php?objektID=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $mv_verwID);
            mysqli_stmt_execute($stmt);
            $result_objektID = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_objektID)){
                
                $wg_objektID = $row['ObjektID'];
            }
            
        }
        //Adresse des Hausobjekts
        if(!mysqli_stmt_prepare($stmt, $wg_ho_adresse_sql)){
            header("Location: ../add_mietverhaeltnis.php?adresse=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $wg_objektID);
            mysqli_stmt_execute($stmt);
            $result_adresse = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_adresse)){
                
                $wg_ho_strasse = $row['Strasse'];
                $wg_ho_hausnr = $row['Hausnr'];
                $wg_ho_plz = $row['PLZ'];
                $wg_ho_ort = $row['Ort'];
            }
            
        }
        //Kommentar aus Verwaltungseinheit
        if(!mysqli_stmt_prepare($stmt, $wg_verw_sql)){
            header("Location: ../add_mietverhaeltnis.php?kommentar=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $mv_verwID);
            mysqli_stmt_execute($stmt);
            $result_kommentar = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_kommentar)){
                
                $wg_kommentar = $row['Kommentar'];
                $wg_besitzer = $row['Besitzer'];
            }
            
        }
        //Besitzer der Verwaltungseinheit
            if(!mysqli_stmt_prepare($stmt, $wg_namen_sql)){
                header("Location: ../add_mietverhaeltnis.php?kommentar=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "i", $wg_besitzer);
                mysqli_stmt_execute($stmt);
                $result_besitzer = mysqli_stmt_get_result($stmt);
                if($row=mysqli_fetch_assoc($result_besitzer)){
                    
                    $wg_eigentuemer_vorname = $row['Vorname'];
                    $wg_eigentuemer_name = $row['Name'];
                    $wg_eigentuemer_strasse = $row['Strasse'];
                    $wg_eigentuemer_hausnr = $row['Hausnr'];
                    $wg_eigentuemer_plz = $row['PLZ'];
                    $wg_eigentuemer_ort = $row['Ort'];
                }
            } 
        
        
        //Tabelle erstellen
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetFont('Times','B',12);
        $pdf->SetWidths(array(85,85));
        $pdf->Cell(13);
        $pdf->Cell(10,10,"EINZUG",0,0);
        $pdf->Ln(4);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Wohnungsgeberbestaetigung zur Vorlage bei der Meldebehoerde",0,0);
        $pdf->Ln(8);
        $pdf->SetFont('Times','B',9);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Auszug aus §19 Abs. 1 Satz 1 und 2 BMG Mitwirkung des Wohnungsgebers",0,0);
        $pdf->Ln(8);
        $pdf->SetFont('Times','',8);
        $pdf->Cell(13);
        $pdf->MultiCell(170,4,"(1) Der Wohnungsgeber ist verpflichtet, bei der An- oder Abmeldung mitzuwirken. Hierzu hat der Wohnungsgeber oder eine von ihm beauftragte Person der meldepflichtigen Person den Einzug oder Auszug schriftlich oder elektronisch innerhalb der in §17 Absatz 1 oder 2 genannten Fristen (2 Wochen) zu bestaetigen", 0,"L",false);
        $pdf->Ln(4);
        $pdf->SetFont('Times','B',9);
        $pdf->Cell(14);
        $pdf->MultiCell(170,6,"Angaben zum Wohnungsgeber:", 1,"L",false);
        
        $pdf->SetFont('Times','',9);
        $pdf->Cell(14);
        $pdf->MultiCell(170,4,"Familienname / Vorname oder
            Bezeichnung bei einer juristischen Person:      [$wg_vermieter_name, $wg_vermieter_vorname]
            
            Strasse / Hausnummer /
            Adressierungszusaetze:                                     [$wg_vermieter_strasse $wg_vermieter_hausnr]
            
            PLZ / Ort:                                                         [$wg_vermieter_plz $wg_vermieter_ort]
            
            Telefonnummer: (Angabe freiwillig)               [                                                ]
            
            ", 1,"L",false);
        
        $pdf->Ln(2);
        $pdf->SetFont('times','',9);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Der Name und die Anschrift des Eigentuemers lauten:",0,0);
        $pdf->Ln(7);
        
        $pdf->Cell(14);
        $pdf->MultiCell(170,4,"Familienname / Vorname oder
            Bezeichnung bei einer juristischen Person:      [$wg_eigentuemer_name, $wg_eigentuemer_vorname]
            
            Strasse / Hausnummer /
            Adressierungszusaetze:                                     [$wg_eigentuemer_strasse $wg_eigentuemer_hausnr]
            
            PLZ / Ort:                                                         [$wg_eigentuemer_plz $wg_eigentuemer_ort]
            
            ", 0,"L",false);
        
        $pdf->SetFont('Times','B',9);
        $pdf->Cell(14);
        $pdf->MultiCell(170,6,"Anschrift der Wohnung in die eingezogen wird:", 1,"L",false);
        
        $pdf->SetFont('Times','',9);
        $pdf->Cell(14);
        $pdf->MultiCell(170,4,"Strasse / Hausnummer:                                   [$wg_ho_strasse $wg_ho_hausnr]
            
            Zusatzangaben (z.B. Stockwerks- oder
            Wohnungsnummer):                                       [WohnungsID: $mv_verwID / $wg_kommentar]
            
            PLZ / Ort:                                                       [$wg_ho_plz $wg_ho_ort]
            
            ", 1,"L",false);
        $pdf->SetFont('times','',9);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"In die oben genannte Wohnung ist/sind am [$mv_beginn] folgende Person/en eingezogen:",0,0);
        $pdf->Ln(6);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Familienname:[$wg_mieter_name] Vorname:[$wg_mieter_vorname] ",0,0);
        $pdf->Ln(6);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Familienname:[                                         ] Vorname:[                                         ] ",0,0);
        $pdf->Ln(6);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Familienname:[                                         ] Vorname:[                                         ] ",0,0);
        $pdf->Ln(6);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Familienname:[                                         ] Vorname:[                                         ] ",0,0);
        $pdf->Ln(6);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Familienname:[                                         ] Vorname:[                                         ] ",0,0);
        $pdf->Ln(12);
        $pdf->SetFont('times','',8);
        $pdf->Cell(13);
        $pdf->MultiCell(170,4,"Ich bestaetige mit meiner Unterschrift den Einzug der oben genannten Person(en) in die oben bezeichnete Wohnung und dass ich als Wohnungsgeber oder als beauftragte Person diese Bescheinigung ausstellen darf.", 0,"L",false);
        $pdf->Ln(4);
        $pdf->Cell(13);
        $pdf->MultiCell(170,4,"Ich habe davon Kenntnis genommen, dass ich ordnungswidrig handle, wenn ich hierzu nicht berechtigt bin, und dass es verboten ist, eine Wohnanschrift fuer eine Anmeldung eines Wohnsitzes einem Dritten anzubieten oder zur Verfuegung zu stellen, obwohl ein tatsaechlicher Bezug der Wohnung durch einen Dritten weder stattfindet noch beabsichtigt ist.", 0,"L",false);
        $pdf->Ln(4);
        $pdf->Cell(13);
        $pdf->MultiCell(170,4,"Ein Verstoss gegen dieses Verbot stellt eine Ordnungswidrigkeit dar und kann mit einer Geldbusse bis zu 50.000 Euro geahndet werden. Das Unterlassen einer Bestaetigung des Einzugs sowie die falsche oder nicht rechtzeitige Bestaetigung des Einzugs koennen als Ordnungswidrigkeiten mit Geldbussen bis zu 1.000 Euro geahndet werden.", 0,"L",false);
        $pdf->Ln(4);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"[                  ]         [                             ]",0,0);
        $pdf->Ln(3);
        $pdf->SetFont('times','',6);
        $pdf->Cell(13);
        $pdf->Cell(10,10,"Datum                                              Unterschrift des Wohnungsgebers oder des Wohnungseigentuemers",0,0);
        $pdf->Output();
        
        
        
    }

// ##############################################################################################################################

    if(isset($_POST['zimmer_submit'])){
        
        $zm_verwID =  $_POST['zm_verwaltungseinheit'];
        $zm_bezeichnung = $_POST['zm_bezeichnung'];
        $rm_modell = $_POST['zm_rm_modell'];
        $rm_wartung = $_POST['zm_rm_wartung'];
        $rm_datum = $_POST['zm_rm_installiert'];
        
        if(empty($zm_verwID) || empty($zm_bezeichnung)){
            header("Location: ../add_zimmer.php?zimmer_error=emptyfields");
            exit();
        }
        
        else{
            $zm_sql = "INSERT INTO zimmer (VerwID, Bezeichnung) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $zm_sql)){
                header("Location: ../add_zimmer.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "is", $zm_verwID, $zm_bezeichnung);
                mysqli_stmt_execute($stmt);
            }
            $zm_sql_select ="SELECT * FROM zimmer ORDER BY ZimmerID DESC LIMIT 1";
            
            $zm_rm_sql = "INSERT INTO rauchmelder (ZimmerID, Modell, Wartung, Installiert) VALUES (?, ?, ?, ?)";
            
            //Gerade hinzugefügte ZimmerID holen
            $result_zm_select = mysqli_query($conn, $zm_sql_select);
            if($row=mysqli_fetch_assoc($result_zm_select)){
                $zimmerID_temp = $row['ZimmerID'];
            }
            //Mit ZimmerID in Rauchmelder einsetzen
            if(!mysqli_stmt_prepare($stmt, $zm_rm_sql)){
                header("Location: ../add_zimmer.php?error=add_rm_sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "isis", $zimmerID_temp, $rm_modell, $rm_wartung, $rm_datum);
                mysqli_stmt_execute($stmt);
                
            }
            
            
            header("Location: ../add_zimmer.php?insert=success");
            exit();
            
        }
        
    }
    
?>
