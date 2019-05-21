<?php
    require "header.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    echo '
		<h2>Gruesse verschicken<span class="badge badge-secondary"></span></h2>
        <br>
        <h4>"Sehr geehrte/r Frau/Herr: ..."
        <br>
        <br>
		<form action="includes/gruesse.inc.php" method="post">
			
            <textarea class="form-control" rows="3" type="text" name="text"></textarea>
			<br>
            <h5>Mit freundlichen Gruessen: ..</h5>
            
            <textarea class="form-control" rows="1" type="text" name="ende"></textarea>
			<br>
			<button class="btn btn-success btn-lg" type="submit" name="gruesse_submit">Versenden</button>
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
