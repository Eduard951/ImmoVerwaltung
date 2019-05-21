<?php
    require "includes/dbh.inc.php";
    require "header.php";
?>

	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    $sql = "SELECT adresse.Ort,adresse.PLZ,adresse.Strasse, adresse.Hausnummer,hausobjekt.Typ FROM hausobjekt JOIN adresse ON hausobjekt.Adresse=adresse.AdresseID";
	    $result = $conn->query($sql);
	        
	           if (!empty($result)) {
	            while($row = $result->fetch_assoc()) {
	                
	                echo '
                    <br><h3><a href="index.php">'.$row['Ort']," " ,$row['PLZ']," ",$row['Strasse']," ",$row['Hausnummer']," ",$row['Typ'].'</h3>';
	                
	            }
	            
	        
	    
	}else {
	   echo' <p></p>';
	}
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>