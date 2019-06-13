<?php

    require 'header.php';
    require 'includes/dbh.inc.php';
    
    if(isset($_SESSION['sessionid'])){
        $session_verwID = $_SESSION['objektid'];
        
        $ve_hausobjekt_sql = "SELECT * FROM verwaltungseinheit WHERE VerwID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $ve_hausobjekt_sql)){
            header("Location: ../update_hausobjekt.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $session_verwID);
            mysqli_stmt_execute($stmt);
            $result_objektID = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_objektID)){
                $ve_objektID = $row['ObjektID'];

            }
        }
        
        $ho_data_sql = "SELECT * FROM hausobjekt WHERE ObjektID = ?";
        
        if(!mysqli_stmt_prepare($stmt, $ho_data_sql)){
            header("Location: ../update_hausobjekt.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $ve_objektID);
            mysqli_stmt_execute($stmt);
            $result_ho_data = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_ho_data)){
                
                $ho_kommentar = $row['Kommentar'];
                $ho_besitzer = $row['Besitzer'];
                $ho_typ = $row['Typ'];
                $ho_lageplan = $row['Lageplan'];
                $ho_bauplan = $row['Bauplan'];
                $ho_versammlung = $row['Versammlung'];
                $ho_strasse = $row['Strasse'];
                $ho_hausnr = $row['Hausnr'];
                $ho_plz = $row['PLZ'];
                $ho_ort = $row['Ort'];
                $ho_anteile = $row['Anteile'];
                
            }
        }
        
        if ($ho_typ == "Einfamilienhaus") {
            $enum = 0;
            $enum_text = '<option selected="selected" value="1">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>'; 
        } elseif ($ho_typ == "Zweifamilienhaus") {
            $enum = 1;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option selected="selected" value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>'; 
        } elseif ($ho_typ == "Doppelhaus") {
            $enum = 2;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option selected="selected" value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "Reihenhaus") {
            $enum = 3;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option selected="selected" value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "Mehrfamilienhaus") {
            $enum = 4;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option selected="selected" value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "Wohnhochhaus") {
            $enum = 5;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option selected="selected" value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "Villa") {
            $enum = 6;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option selected="selected" value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "Bungalow") {
            $enum = 7;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option selected="selected" value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "Schloss") {
            $enum = 8;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option selected="selected" value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "Wohn- und Geschäftsgebäude") {
            $enum = 9;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option selected="selected" value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "Geschäftsgebäude") {
            $enum = 10;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option selected="selected" value="11">Geschäftsgebäude</option>
        	<option value="12">andere</option>';
        } elseif ($ho_typ == "andere") {
            $enum = 11;
            $enum_text = '<option value="0">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
        	<option selected="selected" value="12">andere</option>';
        }
        
?>
<!-- Formular für Hausobjekt hinzufügen  -->
<h2>Hausobjekt bearbeiten</h2>

<form enctype="multipart/form-data" action="includes/update.inc.php" method="post">
	<p>
	<label>ID:</label>
	<input type="text" name="ho_objektid" value="<?php echo $ve_objektID; ?>" readonly>
	</p>
    <p>
    	<label>Typ:</label>
      	<select name="ho_typ">
            <?php echo $enum_text; ?>
            
      	</select> 
    </p>
    <p>
    <!-- Eigentümer auswählen aus Benutzertabelle  -->
    <label>Eigentümer:</label>
    	<select name="ho_eigentuemer">
    	<!-- "NULL", wenn kein Benutzer ausgewählt wurde 
    		<option value="">-kein Eigentümer-</option> -->
          <?php 
            //Besitzerdaten holen
            $ho_besitzer_sql = "SELECT Vorname, Name FROM benutzer JOIN hausobjekt on benutzer.BenutzerID = hausobjekt.Besitzer WHERE BenutzerID = ?";
            //Benutzerauswahl, wenn Besitzer vorhanden ist
            $ho_benutzer_besitzer_sql = "SELECT BenutzerID, Vorname, Name FROM benutzer WHERE NOT (BenutzerID = ?)";
            //Benutzerauswahl, wenn kein Eigentümer vorhanden
            $ho_benutzer_sql = "SELECT BenutzerID, Vorname, Name FROM benutzer";
            
            if(!empty($ho_besitzer)) {
   
                if(!mysqli_stmt_prepare($stmt, $ho_besitzer_sql)){
                    header("Location: ../update_hausobjekt.php?besitzer_error=sqlerror");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "i", $ho_besitzer);
                    mysqli_stmt_execute($stmt);
                    $result_ho_besitzer = mysqli_stmt_get_result($stmt);
                    if($row=mysqli_fetch_assoc($result_ho_besitzer)){
                        
                        $ho_besitzer_vorname = $row['Vorname'];
                        $ho_besitzer_name = $row['Name'];
                    }
                }
                echo '<option selected="selected" value="'.$ho_besitzer.'">'.$ho_besitzer_vorname.' '.$ho_besitzer_name.'</option>';
                
                if(!mysqli_stmt_prepare($stmt, $ho_benutzer_besitzer_sql)){
                    header("Location: ../update_hausobjekt.php?benutzer_error=sqlerror");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "i", $ho_besitzer);
                    mysqli_stmt_execute($stmt);
                    $result_ho_benutzer = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result_ho_benutzer) > 0) {
                        while($row = mysqli_fetch_assoc($result_ho_benutzer)) {
                            echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                        }
                    }
                }
                
            }else{
                echo '<option selected="selected" value="">-kein Eigentümer-</option>';
                $result_ho_benutzerliste = mysqli_query($conn, $ho_benutzer_sql);
                
                if (mysqli_num_rows($result_ho_benutzerliste) > 0) {
                    while($row = mysqli_fetch_assoc($result_ho_benutzerliste)) {
                        echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                    }
                }
            }
        
    
            ?>
    	</select>
    </p>
    <p>
        <label>Strasse:</label>
        <input type="text" name="ho_strasse" value="<?php echo $ho_strasse ?>">
    </p>
    <p>
        <label>Hausnummer:</label>
        <input type="number" name="ho_hausnr" value="<?php echo $ho_hausnr ?>">
    </p>
    <p>
        <label>Postleitzahl:</label>
        <input type="number" name="ho_plz" value="<?php echo $ho_plz ?>">
    </p>
	<p>
        <label>Ort:</label>
        <input type="text" name="ho_ort" value="<?php echo $ho_ort ?>">
    </p>
    <p>
        <label>Lageplan:</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <input type="file" name="ho_lageplan" >
    </p>
    <p>
        <label>Bauplan:</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <input type="file" name="ho_bauplan">
    </p>
    <p>
        <label>Kommentar:</label>
        <input type="text" name="ho_kommentar" id="kommentar" value="<?php echo $ho_kommentar ?>">
    </p>
        <label>Versammlung:</label>
        	<fieldset name="ho_versammlung">
        		<?php if($ho_versammlung == 0){
        		    echo'<input type="radio" id="nein" name="ho_versammlung" value="0" checked>
        		         <label for="nein">Nein</label>
        		         <input type="radio" id="ja" name="ho_versammlung" value="1">
        		         <label for="ja">Ja</label>';
        		}else if($ho_versammlung == 1){ 
        		    echo '<input type="radio" id="nein" name="ho_versammlung" value="0">
        		         <label for="nein">Nein</label>
                         <input type="radio" id="ja" name="ho_versammlung" value="1" checked>
                         <label for="ja">Ja</label>';
        		}
        		?>
                
            </fieldset>
    <button class="btn btn-secondary btn-lg" type="submit" name="ho_update_submit">Daten aktualisieren</button>
</form>

<?php 

    }
    
?>