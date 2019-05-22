<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    $sql = "SELECT benutzer.Vorname, benutzer.Name 
                FROM benutzer 
                JOIN mietverhaeltnis
                ON benutzer.BenutzerID = mietverhaeltnis.Mieter
                OR benutzer.BenutzerID = mietverhaeltnis.Vermieter
                ";
	    
               // JOIN mieter
              //  ON benutzer.BenutzerID= mieter.BenutzerID
              //  JOIN mietverhaeltnis
               // ON mieter.MieterID= mietverhaeltnis.MieterID
               // JOIN mietverhaeltnis
                //ON vermieter.VermieterID= mietverhaeltnis.VermieterID
               // JOIN hausobjekt
               // ON hausobjekt.ObjektID= mietverhaeltnis.ObjektID
               // ";
	    
	    $result = $conn->query($sql);
	    
	    echo '
		<h2>Gruesse verschicken<span class="badge badge-secondary"></span></h2>
        <br>
        <h4>"Sehr geehrte/r Frau/Herr: ..."
        <br>
        <br>
		<form action="includes/gruesse.inc.php" method="post" target="_blank">
			
            <textarea class="form-control" rows="3" type="text" name="text"></textarea>
			<br>
            <h5>Mit freundlichen Gruessen: ..</h5>
            
            <textarea class="form-control" rows="1" type="text" name="ende"></textarea>
			<br>
			
		  ';    
		  if(!empty($result)){
		      while($row = $result->fetch_assoc()){
		          echo '<br><input type="checkbox" name="empfaenger[]" value="'.$row['Name']," ", $row['Vorname'].'">'.$row['Name']," ", $row['Vorname'].'<br>
   
                    ';
		      }
		  }
            echo'
        
        <br><button class="btn btn-success btn-lg" type="submit" name="gruesse_submit">Versenden</button>

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
