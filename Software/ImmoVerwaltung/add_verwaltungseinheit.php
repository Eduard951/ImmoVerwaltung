<?php
    require 'header.php';
    require 'includes/dbh.inc.php';
    if(isset($_SESSION['sessionid'])){

?>

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
    
            $sql3 = 'SELECT BenutzerID, Vorname, Name FROM Benutzer';
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

<?php }

?>