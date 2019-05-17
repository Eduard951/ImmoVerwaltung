<?php
    require "header.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionname'])){
	    echo '<br><a href="gruesse.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="gruesse_submit">Gruesse</button>';
	}else {
	   echo' <p></p>';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>