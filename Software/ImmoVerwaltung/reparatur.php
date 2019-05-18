<?php
    require "header.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionname'])){
	    echo '
		<h2>Beschwerdeeinrichtung<span class="badge badge-secondary"></span></h2>
		<form action="includes/reparatur.inc.php" method="post">
			
            <textarea class="form-control" rows="3" type="text" name="text"></textarea>
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