<?php
require 'header.php';
require 'includes/dbh.inc.php';
if(isset($_SESSION['sessionid'])){
    
    ?>
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