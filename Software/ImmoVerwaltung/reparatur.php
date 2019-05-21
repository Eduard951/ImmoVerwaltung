<?php
    require "header.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    echo '
		<h2>Beschwerdeeinrichtung<span class="badge badge-secondary"></span></h2>
        
		<form action="includes/reparatur.inc.php" method="post" enctype="multipart/form-data">	
            <textarea class="form-control" rows="3" type="text" name="text"></textarea>
			<br>
            <h3>Bild hinzufuegen:</h3>
            <input type="file" name="file">
            <br>
            <br>
            <button class="btn btn-success btn-lg" type="submit" name="reparatur_submit">Beschwerde versenden</button>
		</form>
';
	}else {
	   echo'';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>