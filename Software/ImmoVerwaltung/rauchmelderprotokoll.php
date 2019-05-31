<?php
require "header.php";
require "includes/dbh.inc.php";
?>


<main>
	<?php 
// Prepared statements erstellen
	if(isset($_SESSION['sessionid'])){
	    
	    $sql = "SELECT hausobjekt.ObjektID, verwaltungseinheit.VerwID, hausobjekt.Strasse, hausobjekt.Hausnr, hausobjekt.PLZ, hausobjekt.Ort, verwaltungseinheit.Kommentar, verwaltungseinheit.Besitzer, benutzer.vorname, benutzer.name
                FROM   verwaltungseinheit
               JOIN hausobjekt
                ON verwaltungseinheit.ObjektID = hausobjekt.ObjektID
               JOIN benutzer
                ON  verwaltungseinheit.Besitzer = benutzer.BenutzerID
                WHERE BenutzerID = ?";

	    $stmt = mysqli_stmt_init($conn);
	    
	    
	    if(!mysqli_stmt_prepare($stmt, $sql)){
	        header("Location: ../index.php?error=sqlerror");
	        exit();
	    }else{
	        
	        mysqli_stmt_bind_param($stmt, "i", $_SESSION['sessionid']);
	        mysqli_stmt_execute($stmt);
	        $result = mysqli_stmt_get_result($stmt);

echo '
		<h2>Rauchmelderwartungsprotokoll erstellen<span class="badge badge-secondary"></span></h2>
        <br>
        <form action="includes/rauchmelderprotokoll.inc.php" method="post" target="_blank">
        <h4>Für welche Verwaltungseinheit soll das Protokoll erstellt werden?
        <br>
';

if(!empty($result)){
    while($row = $result->fetch_assoc()){
        echo '<br><input type="checkbox" name="verwaltungseinheit[]" value="'.$row['ObjektID'],"*", $row['VerwID'], "*", $row['Strasse'], "*", $row['Hausnr'], "*", $row['PLZ'], "*", $row['Ort'], "*", $row['Kommentar'], "*", $row['vorname'], "*", $row['name'].'">'."HausobjektID: ", $row['ObjektID'],"/ Verw.-Einheit: ", $row['VerwID'], "/<br /> ", $row['Strasse'], " ", $row['Hausnr'], ", ", $row['PLZ'], " ", $row['Ort'].'<br>
        ';
    }
}
echo '<br><button class="btn btn-success btn-lg" type="submit" name="wartungsprotokoll_submit">Generieren</button>
            
        </form>
<br><br><br><a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>
';
	    }
	}else {
	    echo'';
	}
	?>
	</main>
	
<?php 
    require "footer.php";
?>