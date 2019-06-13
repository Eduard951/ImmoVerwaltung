<?php

require 'header.php';
require 'includes/dbh.inc.php';

if(isset($_SESSION['sessionid'])){
    
     $verwID = $_SESSION['objektid'];
        
        $ve_data_sql = "SELECT * FROM verwaltungseinheit WHERE VerwID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $ve_data_sql)){
            header("Location: ../update_verwaltungseinheit.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $verwID);
            mysqli_stmt_execute($stmt);
            
            $result_ve_data = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_ve_data)){
                $ve_objektID = $row['ObjektID'];
                $ve_kommentar = $row['Kommentar'];
                $ve_besitzer = $row['Besitzer'];
                $ve_wohnflaeche = $row['Wohnflaeche'];
                $ve_typ = $row['Typ'];
                $ve_bauplan = $row['Bauplan'];
                $ve_vs_muell = $row['VS_Muell'];
                $ve_vs_aufzug = $row['VS_Aufzug'];
                $ve_vs_eigentumsanteil = $row['VS_Eigentumsanteil'];
                $ve_vs_verwaltergebuehr = $row['VS_Verwaltergebuehr'];
            }
        }
        
        if ($ve_typ == "Wohnung") {
            $enum = 0;
            $enum_text = '<option selected="selected" value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>';
        } elseif ($ve_typ == "Geschäft") {
            $enum = 1;
            $enum_text = '<option value="1">Wohnung</option>
        	<option selected="selected" value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>';
        } elseif ($ve_typ == "Etage") {
            $enum = 2;
            $enum_text = '<option value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option selected="selected" value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>';
        } elseif ($ve_typ == "Loft") {
            $enum = 3;
            $enum_text = '<option value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option selected="selected" value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>';
        } elseif ($ve_typ == "Penthouse") {
            $enum = 4;
            $enum_text = '<option value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option selected="selected" value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>>';
        } elseif ($ve_typ == "Einliegerwohnung") {
            $enum = 5;
            $enum_text = '<option value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option selected="selected" value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>';
        } elseif ($ve_typ == "Maisonettewohnung") {
            $enum = 6;
            $enum_text = '<option value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option selected="selected" value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>';
        } elseif ($ve_typ == "Etagenwohnung") {
            $enum = 7;
            $enum_text = '<option value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option selected="selected" value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>';
        } elseif ($ve_typ == "Souterrainwohnung") {
            $enum = 8;
            $enum_text = '<option value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option selected="selected" value="9">Souterrainwohnung</option>
        	<option value="10">andere</option>';
        } elseif ($ve_typ == "andere") {
            $enum = 9;
            $enum_text = '<option value="1">Wohnung</option>
        	<option value="2">Geschäft</option>
        	<option value="3">Etage</option>
        	<option value="4">Loft</option>
        	<option value="5">Penthouse</option>
        	<option value="6">Einliegerwohnung</option>
        	<option value="7">Maisonettewohnung</option>
        	<option value="8">Etagenwohnung</option>
        	<option value="9">Souterrainwohnung</option>
        	<option selected="selected" value="10">andere</option>';
        }
        
        ?>

<!-- Formular für Verwaltungseinheiten  -->
<h2>Verwaltungseinheit bearbeiten</h2>
    <form enctype="multipart/form-data" action="includes/update.inc.php" method="post">
    <p>
    <label>Hausobjekt:</label>
    <input type="text" name="ve_hausobjekt" value="<?php echo $ve_objektID ?>" readonly>
    <label>Verwaltungseinheit:</label>
    <input type="text" name="ve_verwID" value="<?php echo $verwID ?>" readonly>
    </p>
    <p>
    	<label>Typ:</label>
      	<select name="ve_typ">
            <?php echo $enum_text; ?>
      	</select> 
    </p>
	<p>
        <label>Wohnfläche:</label>
        <input type="number" name="ve_wohnflaeche" value="<?php echo $ve_wohnflaeche; ?>">
    </p>
    <p>
        <label>Bauplan:</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <input type="file" name="ve_bauplan">
    </p>
    <p>
        <label>Kommentar:</label>
        <input type="text" name="ve_kommentar" value="<?php echo $ve_kommentar; ?>">
    </p>
     <p>
    <!-- Eigentümer auswählen aus Benutzertabelle  -->
    <label>Eigentümer:</label>
    	<select name="ve_eigentuemer">
    	<!-- "NULL", wenn kein Benutzer ausgewählt wurde 
    		<option value="">-kein Eigentümer-</option> -->
          <?php 
            //Besitzerdaten holen
            $ve_besitzer_sql = "SELECT Vorname, Name FROM benutzer JOIN verwaltungseinheit ON benutzer.BenutzerID = verwaltungseinheit.Besitzer WHERE BenutzerID = ?";
            //Benutzerauswahl, wenn Besitzer vorhanden ist
            $ve_benutzer_besitzer_sql = "SELECT BenutzerID, Vorname, Name FROM benutzer WHERE NOT (BenutzerID = ?)";
            //Benutzerauswahl, wenn kein Eigentümer vorhanden
            $ve_benutzer_sql = "SELECT BenutzerID, Vorname, Name FROM benutzer";
            
            if(!empty($ve_besitzer)) {
   
                if(!mysqli_stmt_prepare($stmt, $ve_besitzer_sql)){
                    header("Location: ../update_verwaltungseinheit.php?besitzer_error=sqlerror");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "i", $ve_besitzer);
                    mysqli_stmt_execute($stmt);
                    $result_ve_besitzer = mysqli_stmt_get_result($stmt);
                    if($row=mysqli_fetch_assoc($result_ve_besitzer)){
                        
                        $ve_besitzer_vorname = $row['Vorname'];
                        $ve_besitzer_name = $row['Name'];
                    }
                }
                echo '<option selected="selected" value="'.$ve_besitzer.'">'.$ve_besitzer_vorname.' '.$ve_besitzer_name.'</option>';
                
                if(!mysqli_stmt_prepare($stmt, $ve_benutzer_besitzer_sql)){
                    header("Location: ../update_verwaltungseinheit.php?benutzer_error=sqlerror");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "i", $ve_besitzer);
                    mysqli_stmt_execute($stmt);
                    $result_ve_benutzer = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result_ve_benutzer) > 0) {
                        while($row = mysqli_fetch_assoc($result_ve_benutzer)) {
                            echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                        }
                    }
                }
                
            }else{
                echo '<option selected="selected" value="">-kein Eigentümer-</option>';
                $result_ve_benutzerliste = mysqli_query($conn, $ve_benutzer_sql);
                
                if (mysqli_num_rows($result_ve_benutzerliste) > 0) {
                    while($row = mysqli_fetch_assoc($result_ve_benutzerliste)) {
                        echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                    }
                }
            }
        
    
            ?>
    	</select>
    </p>
    <h4>Verteilungsschlüssel</h4>
        <p>
            <label>Müll:</label>
            <input type="number" name="ve_muell" value="<?php echo $ve_vs_muell; ?>" min="0" max="1000">
        </p>
        <p>
            <label>Aufzug:</label>
            <input type="number" name="ve_aufzug" value="<?php echo $ve_vs_aufzug; ?>" min="0" max="1000">
        </p>
        <p>
            <label>Eigentumsanteil:</label>
            <input type="number" name="ve_eigentumsanteil" value="<?php echo $ve_vs_eigentumsanteil; ?>" min="0" max="1000">
        </p>
        <p>
            <label>Verwaltergebühr:</label>
            <input type="number" name="ve_verwaltergebuehr" value="<?php echo $ve_vs_verwaltergebuehr; ?>" min="0" max="1000">
        </p>
        
    <button class="btn btn-secondary btn-lg" type="submit" name="ve_update_submit">Verwaltungseinheit aktualisieren</button>
</form>

<?php 
    
    }

?>
