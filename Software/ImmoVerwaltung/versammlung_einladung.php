<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    $sql = "";
	    
	   // $result = $conn->query($sql);
	    
	    echo '
		<h2>Eigentuemerversammlung: Einladung<span class="badge badge-secondary"></span></h2>
        
        <h5>Datum(Pflichtfeld) :</h5>
        
		<form action="./includes/versammlung_einladung.inc.php" method="post" target="_blank">
			
            <input class="form-control" type="date" name="datum">
			
            <br>
            <h5>Uhrzeit(Pflichtfeld) :</h5>
            <input class="form-control" type="text" name="uhrzeit">

			<br>
            <h5>Ort(Pflichtfeld) : </h5>
            <input class="form-control" type="text" name="Ort">

			<br>
            <h5>Einladung Text(Pflichtfeld) : </h5>
            <textarea class="form-control" rows="3" type="text" name="text"></textarea>

            <br>
            <h5>Tagesablauf: </h5><br>
            <h5>Vorlage: </h5>
                <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vorlage<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li>1 ()</a></li>
                      <li>2 ()</a></li>
                      <li>3 ()</a></li>
                      
                    </ul>
                </div>
            <br>
            <h5>Neu: </h5>
            <textarea class="form-control" rows="3" type="text" name="text_tagesablauf"></textarea>                

		  ';    

            echo'
        
        <br><button class="btn btn-success btn-lg" type="submit" name="versammlung_einladung_submit">Einladungen versenden</button>

        </form>
        <br><a href="versammlung_uebersicht.php"><button class="btn btn-primary btn-lg">Zurueck</button>
';
	}else {
	   echo'';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>
