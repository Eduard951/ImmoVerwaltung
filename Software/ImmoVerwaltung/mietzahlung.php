<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    echo'

            <h5>Mietzahlungen</h5><br>
<h7>Betrag:</h7>
            <form action="includes/mietzahlung.inc.php" method="post"><input type="text" name="betrag"><br><h7>Text:<h7><input type="text" name="text"><br><h7>Text:<h7><input type="date" name="datum"><br><button class="btn btn-success btn-lg" type="submit" name="miete_submit">Zahlen</button></form>
            <br><a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>
        ';
	    
	}
	?>
	</main>
	
<?php 
    require "footer.php";
?>
