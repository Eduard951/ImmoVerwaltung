<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>


	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    $sql = "SELECT *
                FROM benutzer 
                JOIN mietverhaeltnis
                ON benutzer.BenutzerID = mietverhaeltnis.Mieter
                JOIN verwaltungseinheit 
                ON verwaltungseinheit.VerwID=mietverhaeltnis.VerwID
                WHERE mietverhaeltnis.Vermieter = ?
                AND mietverhaeltnis.VerwID =?
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
	    $stmt = mysqli_stmt_init($conn);
	    
	    
	    if(!mysqli_stmt_prepare($stmt, $sql)){
	        header("Location: ../index.php?error=sqlerror");
	        exit();
	    }else{
	        
	        mysqli_stmt_bind_param($stmt, "ii", $_SESSION['sessionid'], $_SESSION['objektid']);
	        mysqli_stmt_execute($stmt);
	        $result = mysqli_stmt_get_result($stmt);
	    
	    echo '
		<h2>Mahnung verschicken<span class="badge badge-secondary"></span></h2>
        <br>
        <h4>"Sehr geehrte/r Frau/Herr: ..."
        <br>
        <br>
		<form action="includes/mahnung.inc.php" method="post">
			
            <textarea class="form-control" rows="3" type="text" name="text"></textarea>
		  ';    
		  if(!empty($result)){
		      while($row = $result->fetch_assoc()){
		          echo '<br><input type="checkbox" name="empfaenger[]" value="'.$row['Name']," ", $row['Vorname']," ",$row['PLZ']," ",$row['Ort']," ",$row['Strasse']," ",$row['Hausnr']," ",$row['Mieter'].'">'.$row['Name']," ", $row['Vorname']," ",$row['PLZ']," ",$row['Ort']," ",$row['Strasse']," ",$row['Hausnr'].'</input><br>
   
                    ';
		      }
		  }
            echo'
        
        <br><button class="btn btn-success btn-lg" type="submit" name="mahnung_submit">Versenden</button>
	

        </form>
        <br><a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>
';
	    }
	}else {
	   echo'';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>
