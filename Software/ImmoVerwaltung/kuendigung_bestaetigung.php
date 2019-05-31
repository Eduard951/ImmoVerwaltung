<?php
require "header.php";
require "includes/dbh.inc.php";
?>


<main>
	<?php 
// Prepared statements erstellen
	if(isset($_SESSION['sessionid'])){
	    
	    $sql = "SELECT *
                FROM benutzer
                JOIN mietverhaeltnis
                ON benutzer.BenutzerID = mietverhaeltnis.Mieter
                OR benutzer.BenutzerID = mietverhaeltnis.Vermieter
                ";

$result = $conn->query($sql);

echo '
		<h2>Kuendigungsbestaetigung senden<span class="badge badge-secondary"></span></h2>
        <br>
        <form action="includes/kuendigung_bestaetigung.inc.php" method="post" target="_blank">
        <h5>Datum der Kuendigung:</h5>
        <textarea class="form-control" rows="1" type="text" name="kuendigung"></textarea>
	    <br>
        <h5>Ende der Nutzung des Wohnmraums:</h5>
        <textarea class="form-control" rows="1" type="text" name="nutzungsende"></textarea>
		<br>
        <h4>Mieter auswaehlen:
        <br>

';

if(!empty($result)){
    while($row = $result->fetch_assoc()){
        echo '<br><input type="checkbox" name="empfaenger[]" value="'.$row['Name']," ", $row['Vorname'], " ", $row['Strasse'], " ", $row['Hausnr'], " ", $row['PLZ'], " ", $row['Ort'].'">'.$row['Name'],", ", $row['Vorname'], ": ", $row['Strasse'], " ", $row['Hausnr'], ", ", $row['PLZ'], " ", $row['Ort'].'<br>
        ';
    }
}
echo '<br><button class="btn btn-success btn-lg" type="submit" name="kuendigung_bestaetigt_submit">Versenden</button>
            
        </form>
<br><br><br><a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>
';
	}else {
	    echo'';
	}
	?>
	</main>
	
<?php 
    require "footer.php";
?>