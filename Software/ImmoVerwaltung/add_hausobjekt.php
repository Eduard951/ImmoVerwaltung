<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require 'header.php';
    require 'includes/dbh.inc.php';
    if(isset($_SESSION['sessionid'])){
?>

<!-- Formular für Hausobjekt hinzufügen  -->
<h2>Hausobjekt hinzuf�gen</h2>

<form enctype="multipart/form-data" action="includes/insert.inc.php" method="post">
    <p>
    	<label>Typ:</label>
      	<select name="ho_typ">
            <option selected="selected" value="1">Einfamilienhaus</option>
        	<option value="2">Zweifamilienhaus</option>
        	<option value="3">Doppelhaus</option>
        	<option value="4">Reihenhaus</option>
        	<option value="5">Mehrfamilienhaus</option>
        	<option value="6">Wohnhochhaus</option>
        	<option value="7">Villa</option>
        	<option value="8">Bungalow</option>
        	<option value="9">Schloss</option>
        	<option value="10">Wohn- und Gesch�ftsgebäude</option>
        	<option value="11">Gesch�ftsgebäude</option>
        	<option value="12">andere</option>
      	</select> 
    </p>
    <p>
    <!-- Eigentümer auswählen aus Benutzertabelle  -->
    <label>Eigentümer:</label>
    <select name="ho_eigentuemer">
    	<!-- "NULL", wenn kein Benutzer ausgewählt wurde --> 
    	<option value="">-kein Eigentümer-</option>
    <?php 
    
            $sql = 'SELECT BenutzerID, Vorname, Name FROM benutzer';
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                }
            }
            ?>
            </select>
            </p>
    <p>
        <label>Strasse:</label>
        <input type="text" name="ho_strasse" required>
    </p>
    <p>
        <label>Hausnummer:</label>
        <input type="number" name="ho_hausnr" required>
    </p>
    <p>
        <label>Postleitzahl:</label>
        <input type="number" name="ho_plz" required>
    </p>
	<p>
        <label>Ort:</label>
        <input type="text" name="ho_ort" required>
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
        <input type="text" name="ho_kommentar" id="kommentar">
    </p>
        <label>Versammlung:</label>
        	<fieldset name="ho_versammlung">
                <input type="radio" id="nein" name="ho_versammlung" value="0" checked>
                <label for="nein">Nein</label>
                <input type="radio" id="ja" name="ho_versammlung" value="1">
                <label for="ja">Ja</label> 
            </fieldset>
    <button class="btn btn-secondary btn-lg" type="submit" name="hausobjekt_submit">Hausobjekt hinzuf�gen</button>
</form>

<?php }

?>