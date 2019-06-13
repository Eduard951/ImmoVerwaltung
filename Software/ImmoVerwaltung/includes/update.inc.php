<?php

require 'dbh.inc.php';

session_start();
//Hausobjekt einfügen
if(isset($_POST['ho_update_submit'])){
    
    //Hochgeladene Dateien speichern und verschieben
    $uploaddir = '../uploads/';
    $ho_lageplan = $uploaddir.basename($_FILES['ho_lageplan']['name']);
    $ho_bauplan = $uploaddir.basename($_FILES['ho_bauplan']['name']);
    
    if(empty($ho_bauplan)){
        $ho_bauplan = NULL;
    }else{
        if (move_uploaded_file($_FILES['ho_lageplan']['name'], $ho_lageplan)) {
            echo "Lageplan ist valide und wurde erfolgreich hochgeladen.\n";
        }else {
            echo "Beim Hochladen der Datei ist ein Fehler ist aufgetreten.";
        }
    }
    if(empty($ho_bauplan)){
        $ho_lageplan = NULL;
    }else{
        if (move_uploaded_file($_FILES['ho_bauplan']['name'], $ho_bauplan)) {
            echo "Bauplan ist valide und wurde erfolgreich hochgeladen.\n";
        }else {
            echo "Beim Hochladen der Datei ist ein Fehler ist aufgetreten.";
        }
    }

    $ho_objektid = $_POST['ho_objektid'];
    $ho_kommentar = $_POST['ho_kommentar'];
    $ho_besitzer = $_POST['ho_eigentuemer'];
    $ho_typ = $_POST['ho_typ'];
    $ho_versammlung = $_POST['ho_versammlung'];
    $ho_strasse = $_POST['ho_strasse'];
    $ho_hausnr = $_POST['ho_hausnr'];
    $ho_plz = $_POST['ho_plz'];
    $ho_ort = $_POST['ho_ort'];

    $null = NULL;
    
    //Adresse muss ausgefüllt sein
    if(empty($ho_strasse) || empty($ho_hausnr) || empty($ho_plz) || empty($ho_ort)){
        header("Location: ../update_hausobjekt.php?error=emptyfields");
        exit();
    }
    
    else{
        //Hauptbefehl
        $ho_update_sql = "UPDATE hausobjekt SET Kommentar = ?, Besitzer= ?, Typ = ?, Lageplan = ?, Bauplan = ?, Versammlung = ?, Strasse = ?, Hausnr = ?, PLZ = ?, Ort = ? WHERE ObjektID = ?";
        
        $stmt = mysqli_stmt_init($conn);
        
        //TODO: es kommt nie ein SQL-Error (?)
        if(!mysqli_stmt_prepare($stmt, $ho_update_sql)){
            header("Location: ../update_hausobjekt.php?error=update_sqlerror");
            exit();
            
        }else{
            //Hausobjekt einfügen, wenn Kommentarfeld leer ist und Eigentümer nicht angegeben wurde
            if(empty($ho_kommentar)){
                if(empty($ho_besitzer)){
                    mysqli_stmt_bind_param($stmt, "sisbbissssi", $null, $null, $ho_typ, $ho_lageplan, $ho_bauplan, $ho_versammlung, $ho_strasse, $ho_hausnr, $ho_plz, $ho_ort, $ho_objektid);
                    mysqli_stmt_execute($stmt);  
                //Kommentar leer, Eigentümer ausgewählt
                }else{
                    mysqli_stmt_bind_param($stmt, "sisbbissssi", $null, $ho_besitzer, $ho_typ, $ho_lageplan, $ho_bauplan, $ho_versammlung, $ho_strasse, $ho_hausnr, $ho_plz, $ho_ort, $ho_objektid);
                    mysqli_stmt_execute($stmt);
                }
                    
            }else{
                //Kommentar angegeben, Eigentümer nicht
                if(empty($ho_besitzer)){
                    mysqli_stmt_bind_param($stmt, "sisbbissssi", $ho_kommentar, $null, $ho_typ, $ho_lageplan, $ho_bauplan, $ho_versammlung, $ho_strasse, $ho_hausnr, $ho_plz, $ho_ort, $ho_objektid);
                    mysqli_stmt_execute($stmt);  
                //Kommentar und Eigentümer angegeben
                }else{
                    mysqli_stmt_bind_param($stmt, "sisbbissssi", $ho_kommentar, $ho_besitzer, $ho_typ, $ho_lageplan, $ho_bauplan, $ho_versammlung, $ho_strasse, $ho_hausnr, $ho_plz, $ho_ort, $ho_objektid);
                    mysqli_stmt_execute($stmt); 
                }
            }
               
            header("Location: ../update_hausobjekt.php?insert=success");
            exit();
        }
    }
}
// ##############################################################################################################################

if(isset($_POST['ve_update_submit'])){
      
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
 
    $ve_verwID = $_POST['ve_verwID'];
    $ve_kommentar = $_POST['ve_kommentar'];
    $ve_eigentuemer = $_POST['ve_eigentuemer'];
    $ve_typ = $_POST['ve_typ'];
    $ve_wohnflaeche = $_POST['ve_wohnflaeche'];
    $ve_muell = $_POST['ve_muell'];
    $ve_aufzug = $_POST['ve_aufzug'];
    $ve_eigentumsanteil = $_POST['ve_eigentumsanteil'];
    $ve_verwaltergebuehr = $_POST['ve_verwaltergebuehr'];
    
    $null = NULL;
    
        $ve_update_sql = "UPDATE verwaltungseinheit SET Kommentar = ?, Besitzer = ?, Wohnflaeche = ?, Typ = ?, Bauplan = ?, VS_Muell = ?, VS_Aufzug = ?, VS_Eigentumsanteil = ?, VS_Verwaltergebuehr = ? WHERE VerwID = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $ve_update_sql)){
            header("Location: ../update_verwaltungseinheit.php?update_error=sqlerror");
            exit();
        }else{
            if(empty($ve_kommentar)){
                if(empty($ve_eigentuemer)){
                    mysqli_stmt_bind_param($stmt, "sidsbiiiii", $null, $null, $ve_wohnflaeche, $ve_typ, $ve_bauplan, $ve_muell, $ve_aufzug, $ve_eigentumsanteil, $ve_verwaltergebuehr, $ve_verwID);
                mysqli_stmt_execute($stmt);
                }else{
                    mysqli_stmt_bind_param($stmt, "sidsbiiiii", $null, $ve_eigentuemer, $ve_wohnflaeche, $ve_typ, $ve_bauplan, $ve_muell, $ve_aufzug, $ve_eigentumsanteil, $ve_verwaltergebuehr, $ve_verwID);
                mysqli_stmt_execute($stmt);
                }
            }else{
                if(empty($ve_eigentuemer)){
                    mysqli_stmt_bind_param($stmt, "sidsbiiiii", $ve_kommentar, $null, $ve_wohnflaeche, $ve_typ, $ve_bauplan, $ve_muell, $ve_aufzug, $ve_eigentumsanteil, $ve_verwaltergebuehr, $ve_verwID);
                mysqli_stmt_execute($stmt);
                }else{
                    mysqli_stmt_bind_param($stmt, "sidsbiiiii", $ve_kommentar, $ve_eigentuemer, $ve_wohnflaeche, $ve_typ, $ve_bauplan, $ve_muell, $ve_aufzug, $ve_eigentumsanteil, $ve_verwaltergebuehr, $ve_verwID);
                mysqli_stmt_execute($stmt);
                    
                }
            }

            header("Location: ../update_verwaltungseinheit.php?insert=success");
            exit();  
        }
    }

// ##############################################################################################################################

    if(isset($_POST['mietverhaeltnis_update_submit'])){
        
        require "../lib/fpdf181/mc_table.php";
      
//         $mv_verwID =  $_POST['mv_verwaltungseinheit'];
//         $mv_vermieterID = $_POST['mv_vermieter'];
        $mv_mieterID = $_POST['mv_mieter'];
        $mv_beginn = $_POST['mv_beginn'];
        $mv_ende = $_POST['mv_ende'];

        
            $mv_sql = "UPDATE mietverhaeltnis SET Beginn = ?, Ende = ? WHERE Mieter = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $mv_sql)){
                header("Location: ../update_mietverhaeltnis.php?error=sqlerror");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt, "ssi", $mv_beginn, $mv_ende, $mv_mieterID);
                mysqli_stmt_execute($stmt);
            }
            
       header("Location: ../update_mietverhaeltnis.php?insert=success");
       exit();
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
