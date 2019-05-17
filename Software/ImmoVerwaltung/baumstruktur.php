<?php
    require "header.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionname'])){
	    echo '<br><a href="index.php"><h1>Testobjekt</h1>';
	}else {
	   echo' <p></p>';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>