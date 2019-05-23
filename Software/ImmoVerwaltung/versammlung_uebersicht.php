<?php
    require "header.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    echo '<br><a href="versammlung_einladung.php"><button class="btn btn-primary btn-lg btn-block">Einladung</button>
              <br><a href="versammlung_protokoll.php"><button class="btn btn-primary btn-lg btn-block">Protokoll</button>
              <br><a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>
              
';
	}else {
	   echo' <p></p>';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>
