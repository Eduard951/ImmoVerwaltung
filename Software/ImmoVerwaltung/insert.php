<?php
require 'header.php';
require 'includes/dbh.inc.php';
if(isset($_SESSION['sessionid'])){
    $objekt_id = $_SESSION['objektid'];
    
?>

<!-- Formular für Hausobjekt hinzufügen  -->
<h2>Hausobjekt hinzufügen</h2>

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
        	<option value="10">Wohn- und Geschäftsgebäude</option>
        	<option value="11">Geschäftsgebäude</option>
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
    <button class="btn btn-secondary btn-lg" type="submit" name="hausobjekt_submit">Hausobjekt hinzufügen</button>
</form>

<!--  ########################################################################################################################## -->

<!-- Formular für Verwaltungseinheiten  -->
<h2>Verwaltungseinheit hinzufügen</h2>
<form enctype="multipart/form-data" action="includes/insert.inc.php" method="post">
<p>
<label>Hausobjekt:</label>
<input type="text" name="ve_hausobjekt" value="<?php echo $_SESSION['objektid'] ?>" readonly>
<!--  <select name="ve_hausobjekt"> -->
<?php

// $sql2 = 'SELECT ObjektID FROM hausobjekt';
// $result2 = mysqli_query($conn, $sql2);

// if (mysqli_num_rows($result2) > 0) {
//     while($row = mysqli_fetch_assoc($result2)) {
//         echo '<option value="'.$row['ObjektID'].'">'.$row['ObjektID'].'</option>';
//     }
// }



 ?>
<!--         </select> -->
    </p>
    <p>
    	<label>Typ:</label>
      	<select name="ve_typ">
            <option selected="selected" value="0">Wohnung</option>
        	<option value="1">Geschäft</option>
        	<option value="2">Etage</option>
        	<option value="3">Loft</option>
        	<option value="4">Penthouse</option>
        	<option value="5">Einliegerwohnung</option>
        	<option value="6">Maisonettewohnung</option>
        	<option value="7">Etagenwohnung</option>
        	<option value="8">Souterrainwohnung</option>
        	<option value="9">andere</option>
      	</select> 
    </p>
	<p>
        <label>Wohnfläche:</label>
        <input type="number" name="ve_wohnflaeche">
    </p>
    <p>
        <label>Bauplan:</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <input type="file" name="ve_bauplan">
    </p>
    <p>
        <label>Kommentar:</label>
        <input type="text" name="ve_kommentar">
    </p>
    <p>
    <!-- Eigentümer auswählen aus Benutzertabelle  -->
    <label>Eigentümer:</label>
    <select name="ve_eigentuemer">
        <!-- "NULL", wenn kein Benutzer ausgewählt wurde -->
    	<option value="">-kein Eigentümer-</option>
    <?php 
    
            $sql3 = 'SELECT BenutzerID, Vorname, Name FROM benutzer';
            $result3 = mysqli_query($conn, $sql3);
            
            if (mysqli_num_rows($result3) > 0) {
                while($row = mysqli_fetch_assoc($result3)) {
                    echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                }
            }
            ?>
            </select>
            </p>
    <h4>Verteilungsschlüssel</h4>
        <p>
            <label>Müll:</label>
            <input type="number" name="ve_muell">
        </p>
        <p>
            <label>Aufzug:</label>
            <input type="number" name="ve_aufzug">
        </p>
        <p>
            <label>Eigentumsanteil:</label>
            <input type="number" name="ve_eigentumsanteil">
        </p>
        <p>
            <label>Verwaltergebühr:</label>
            <input type="number" name="ve_verwaltergebuehr">
        </p>
        
    <button class="btn btn-secondary btn-lg" type="submit" name="verwaltungseinheit_submit">Verwaltungseinheit hinzufügen</button>
</form>

<!-- #################################################################################################################################################### -->


<!-- Mietverhältnis Formular -->
<h2>Mietverhältnis hinzufügen</h2>
<form enctype="multipart/form-data" action="includes/insert.inc.php" method="post">
	<p>
        <label>Verwaltungseinheit auswählen:</label>
        <select name="mv_verwaltungseinheit">
            <?php 
    
            $sql4 = 'SELECT VerwID FROM verwaltungseinheit';
            $result4 = mysqli_query($conn, $sql4);
            
            if (mysqli_num_rows($result4) > 0) {
                while($row = mysqli_fetch_assoc($result4)) {
                    echo '<option value="'.$row['VerwID'].'">'.$row['VerwID'].'</option>';
                }
            }
            ?>
        </select>
    </p>
    <p>
    	<label>Vermieter auswählen:</label>
      	<select name="mv_vermieter">
            <?php 
    
            $sql5 = 'SELECT BenutzerID, Vorname, Name FROM benutzer';
            $result5 = mysqli_query($conn, $sql5);
            
            if (mysqli_num_rows($result5) > 0) {
                while($row = mysqli_fetch_assoc($result5)) {
                    echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                }
            }
            ?>
      	</select> 
    </p>
	 <p>
    	<label>Mieter auswählen:</label>
      	<select name="mv_mieter">
            <?php 
    
            $sql6 = 'SELECT BenutzerID, Vorname, Name FROM benutzer';
            $result6 = mysqli_query($conn, $sql6);
            
            if (mysqli_num_rows($result6) > 0) {
                while($row = mysqli_fetch_assoc($result6)) {
                    echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                }
            }
            ?>
      	</select> 
    </p>
    <p>
        <label>Beginn:</label>
        <input type="date" name="mv_beginn">
    </p>
    <p>
        <label>Ende:</label>
        <input type="date" name="mv_ende">
    </p>
        
    <button class="btn btn-secondary btn-lg" type="submit" name="mietverhaeltnis_submit">Mietverhältnis hinzufügen</button>
</form>


<!-- #################################################################################################################################################### -->

<!-- Formular für Zimmer -->
    <h2>Zimmer hinzufügen</h2>
    <form enctype="multipart/form-data" action="includes/insert.inc.php" method="post">
    <p>
    <label>Hausobjekt:</label>
    <input type="text" name="zm_hausobjekt" value="<?php echo $_SESSION['objektid'] ?>" readonly>
    </p>
    <p>
     <label>Verwaltungseinheit auswählen:</label>
    <select name="zm_verwaltungseinheit">
            <?php 
    
            $sql7 = 'SELECT VerwID FROM verwaltungseinheit';
            $result7 = mysqli_query($conn, $sql7);
            
            if (mysqli_num_rows($result7) > 0) {
                while($row = mysqli_fetch_assoc($result7)) {
                    echo '<option value="'.$row['VerwID'].'">'.$row['VerwID'].'</option>';
                }
            }
            ?>
        </select>
    </p>
    <p>
    	<label>Bezeichnung:</label>
      	<input type="text" name="zm_bezeichnung">
    </p>
    <p>
    	<label>Rauchmelder verbaut?</label>
      	<fieldset name="zm_rm_verbaut">
                <input type="radio" id="nein" name="zm_rm_verbaut" value="0" checked>
                <label for="nein">Nein</label>
                <input type="radio" id="ja" name="zm_rm_verbaut" value="1">
                <label for="ja">Ja</label> 
        </fieldset>
    </p>
    <p>
    	<label>Modell:</label>
      	<input type="text" name="zm_rm_modell">
    </p>
    <p>
    	<label>Wartung durch:</label>
      	<select name="zm_rm_wartung">
            <?php 
    
            $sql8 = 'SELECT BenutzerID, Vorname, Name FROM benutzer';
            $result8 = mysqli_query($conn, $sql8);
            
            if (mysqli_num_rows($result8) > 0) {
                while($row = mysqli_fetch_assoc($result8)) {
                    echo '<option value="'.$row['BenutzerID'].'">'.$row['Vorname'].' '.$row['Name'].'</option>';
                }
            }
            ?>
      	</select> 
    </p>  
    <p>
    	<label>Installiert am:</label>
      	<input type="date" name="zm_rm_installiert">
    </p>  
    <button class="btn btn-secondary btn-lg" type="submit" name="zimmer_submit">Zimmer hinzufügen</button>
</form>

<?php }

?>