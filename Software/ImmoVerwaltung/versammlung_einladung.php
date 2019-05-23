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
        
        
        
		<form action="./includes/versammlung_einladung.inc.php" method="post" target="_blank">
			
            <h5>Datum(Pflichtfeld) :</h5>
            <input class="form-control" type="date" name="datum">
			
            <br>
            <h5>Uhrzeit(Pflichtfeld) :</h5>
            <input class="form-control" type="text" name="uhrzeit">

			<br>
            <h5>Ort(Pflichtfeld) : </h5>
            <input class="form-control" type="text" name="Ort">
            
            <br>
			<br>
            <h5>Einladung Text(Pflichtfeld) : </h5>
            <textarea class="form-control" rows="3" type="text" name="text"></textarea>

            <br>
           
            <h5>Vorlage: </h5>
                <select class="form-control" name="tagesordnung">
                  <option select="selected">Begruessung,Feststellung der Ordnungsmaessigkeit der Einladung,Beschlussfaehigkeit der Versammlung,Tagesordnung,Wahlen,Verwaltungsberat,Verschiedenes</option>
                  <option>2 (Neu)</option>
                </select>
		  ';    

            echo'
        <br>
        <h5>Anlagen:</h5> 
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
