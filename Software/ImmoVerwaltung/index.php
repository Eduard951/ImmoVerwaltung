<?php
    require "header.php";
?>


	<main>
	<?php 
	if(isset($_SESSION["sessionid"])){
	    
	  $id = $_POST['objektid'];
	  $_SESSION['objektid']=$id;
	    
	    
	    
	    echo '<br><a href="gruesse.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="gruesse_submit">Gruesse</button>
              <br><a href="reparatur.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="reparatur_submit">Reparatur/Beschwerdeeinrichtung</button>
              <br><a href="versammlung_uebersicht.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="reparatur_submit">Eigentuemerversammlung</button>
              <br><a href="kuendigung_bestaetigung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="kuendigung_submit">Kuendigungbestaetigung</button>
              <br><a href="handwerkerverwaltung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="handwerkerverwaltung_submit">Handwerkerverwaltung</button>
              <br><a href="rauchmelderprotokoll.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="rauchmelderprotokoll_submit">Rauchmelderprotokoll</button>
                <br><a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button>
               
'.$_SESSION['objektid'].'
';
	}else {
	   echo' <p></p>';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>
