<?php
    require 'header.php';
    require 'includes/dbh.inc.php';
    if(isset($_SESSION['sessionid'])){
        
        $verwID = $_SESSION['objektid'];
        
?>

<!-- Mietverhältnis Formular -->
<h2>Mietverhältnis hinzufügen</h2>
<form enctype="multipart/form-data" action="includes/insert.inc.php" method="post">
	<p>
        <label>Verwaltungseinheit:</label>
        <input type="text" name="mv_verwaltungseinheit" value="<?php echo $verwID;?>" readonly>  
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

<p></p>
<a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>
<?php }

?>
