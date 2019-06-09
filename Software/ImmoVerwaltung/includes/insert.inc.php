<?php

require 'dbh.inc.php';

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
        echo "Beim Hochladen Datei ist ein Fehler ist aufgetreten.";
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
        $ho_sql_verw ="INSERT INTO verwaltungseinheit (ObjektID, Kommentar, Besitzer, Typ, Bauplan) VALUES (?, ?, ?, ?, ?)";
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
            $result_select = mysqli_query($conn, $ho_sql_select);
            if($row=mysqli_fetch_assoc($result_select)){  
                    $objektID_temp = $row['ObjektID'];
                }
                //Mit ObjektID in Verwaltungseinheit einsetzen
                mysqli_stmt_prepare($stmt, $ho_sql_verw);
                mysqli_stmt_bind_param($stmt, "isisb", $objektID_temp, $ho_ve_kommentar, $ho_besitzer, $ho_ve_typ, $ho_bauplan);
                mysqli_stmt_execute($stmt);
                
            header("Location: ../add_hausobjekt.php?insert=success");
            exit();
        }
    }
// }
// ##############################################################################################################################

if(isset($_POST['verwaltungseinheit_submit'])){
    
//     require 'dbh.inc.php';
    
    $uploaddir = '../uploads/';
    $ve_bauplan = $uploaddir.basename($_FILES['ve_bauplan']['name']);
    
    if (move_uploaded_file($_FILES['ve_bauplan']['name'], $ve_bauplan)) {
        echo "Bauplan ist valide und wurde erfolgreich hochgeladen.\n";
    } else {
        echo "Beim Hochladen Datei ist ein Fehler ist aufgetreten.";
    }
    
    $ve_objektID = $_POST['ve_hausobjekt'];
    $ve_kommentar = $_POST['ve_kommentar'];
    $ve_eigentuemer = $_POST['ve_eigentuemer'];
    $ve_typ = $_POST['ve_typ'];
    $ve_wohnflaeche = ['ve_wohnflaeche'];
    //     $bauplan =  NULL; //$_POST['bauplan'];
    $null = NULL;
    
//     if(empty($ve_kommentar) || empty($ve_wohnflaeche)){
//         header("Location: ../insert.php?verwaltungseinheit_error=emptyfields");
//         exit();
//     }
       echo $ve_eigentuemer;
    
//     else{
        $ve_sql = "INSERT INTO verwaltungseinheit (ObjektID, Kommentar, Besitzer, Wohnflaeche, Typ, Bauplan) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $ve_sql)){
            header("Location: ../add_verwaltungseinheit.php?error=sqlerror");
            exit();
        }else{
            if(empty($ve_kommentar)){
                if(empty($ve_eigentuemer)){
                mysqli_stmt_bind_param($stmt, "isidsb", $ve_objektID, $null, $null, $ve_wohnflaeche, $ve_typ, $ve_bauplan);
                mysqli_stmt_execute($stmt);
                }else{
                mysqli_stmt_bind_param($stmt, "isidsb", $ve_objektID, $null, $ve_eigentuemer, $ve_wohnflaeche, $ve_typ, $ve_bauplan);
                mysqli_stmt_execute($stmt);
                }
            }else{
                if(empty($ve_eigentuemer)){
                mysqli_stmt_bind_param($stmt, "isidsb", $ve_objektID, $ve_kommentar, $null, $ve_wohnflaeche, $ve_typ, $ve_bauplan);
                mysqli_stmt_execute($stmt);
                }else{
                mysqli_stmt_bind_param($stmt, "isidsb", $ve_objektID, $ve_kommentar, $ve_eigentuemer, $ve_wohnflaeche, $ve_typ, $ve_bauplan);
                mysqli_stmt_execute($stmt);
                    
                }
            }
            
            
            
            header("Location: ../add_verwaltungseinheit.php?insert=success");
            exit();
            
        }
    }
// }
// ##############################################################################################################################

    if(isset($_POST['mietverhaeltnis_submit'])){
        
//         require 'dbh.inc.php';
      
        $mv_verwID =  $_POST['mv_verwaltungseinheit'];
        $mv_vermieterID = $_POST['mv_vermieter'];
        $mv_mieterID = $_POST['mv_mieter'];
        $mv_beginn = $_POST['mv_beginn'];
        $mv_ende = $_POST['mv_ende'];
        //     $bauplan =  NULL; //$_POST['bauplan'];
        $null = NULL;
        
        if(empty($mv_verwID) || empty($mv_mieterID) || empty($mv_vermieterID) || empty($mv_beginn) || empty($mv_ende)){
                header("Location: ../add_mietverhaeltnis.php?mietverhaeltnis_error=emptyfields");
                exit();
            }
        
            else{
        $mv_sql = "INSERT INTO mietverhaeltnis (VerwID, Vermieter, Mieter, Beginn, Ende) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $mv_sql)){
            header("Location: ../add_mietverhaeltnis.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "iiiss", $mv_verwID, $mv_vermieterID, $mv_mieterID, $mv_beginn, $mv_ende);
                mysqli_stmt_execute($stmt);
            }

            header("Location: ../add_mietverhaeltnis.php?insert=success");
            exit();
            
        }
    }

    

?>