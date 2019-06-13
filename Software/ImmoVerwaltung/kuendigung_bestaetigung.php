<?php

    require "header.php";
    require "includes/dbh.inc.php";

?>

<main>
	<?php 
// Mieterinformationen durch den Vermieter abfragen
	if(isset($_SESSION['sessionid'])){
	    
	    $sql_mieter = "SELECT * FROM benutzer JOIN mietverhaeltnis ON benutzer.BenutzerID = mietverhaeltnis.Mieter WHERE Vermieter = ?";
	    $stmt = mysqli_stmt_init($conn);
	    
	    if(!mysqli_stmt_prepare($stmt, $sql_mieter)){
	        header("Location: ../kuendigung_bestaetigung.php?mieter_getID_error");
	        exit();
	    }else{
	        $id = $_SESSION['sessionid'];
	        mysqli_stmt_bind_param($stmt, "i", $id);
	        mysqli_stmt_execute($stmt);
	        $result_mieter = mysqli_stmt_get_result($stmt);
	    }

  echo '<h2>Kuendigungsbestaetigung senden<span class="badge badge-secondary"></span></h2>
        <br>
        <form action="includes/kuendigung_bestaetigung.inc.php" method="post">
        <h5>Datum der Kuendigung:</h5>
        <input type="date" name="kuendigungs_datum"></textarea>
	    <br>
        <h5>Ende der Nutzung des Wohnraums:</h5>
        <input type="date" name="nutzungsende_datum"></textarea>
		<br>
        <h4>Mieter auswaehlen:
        <br>';

    if(!empty($result_mieter)){
        while($row = $result_mieter->fetch_assoc()){
            echo '<br><input type="radio" id="'.$row['BenutzerID'].'" name="empfaenger[]" value="'.$row['Name']," ", $row['Vorname'], " ", $row['Strasse'], " ", $row['Hausnr'], " ", $row['PLZ'], " ", $row['Ort'], " ", $row['BenutzerID'].'">'.$row['Name'],", ", $row['Vorname'], ": ", $row['Strasse'], " ", $row['Hausnr'], ", ", $row['PLZ'], " ", $row['Ort'].'
                  <br>';
        }
    }
    echo '<br><button class="btn btn-success btn-lg" type="submit" name="kuendigung_bestaetigt_submit">Versenden</button>
          </form>
          <br><br><br><a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>';
	}else {
	    echo'';
	}
	?>
	</main>
	<p></p>
<a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>
	
