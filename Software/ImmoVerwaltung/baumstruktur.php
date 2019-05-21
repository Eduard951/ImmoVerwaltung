<?php
    //session_start();
    require "includes/dbh.inc.php";
    require "header.php";
?>

	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    $ort_plz = "SELECT Ort,Plz FROM adresse GROUP BY Ort";
	    $sql = "SELECT adresse.Ort,adresse.PLZ,adresse.Strasse, adresse.Hausnummer,hausobjekt.Typ, hausobjekt.ObjektID FROM hausobjekt JOIN adresse ON hausobjekt.Adresse=adresse.AdresseID";
	    $result = $conn->query($sql);
	    $result_ort_plz = $conn->query($sql);
	        
	           //if (!empty($result)) {
	           // while($row = $result->fetch_assoc()) {
	                
	               // echo '
                   // <br><h3><a href="index.php">'.$row['Ort']," " ,$row['PLZ']," ",$row['Strasse']," ",$row['Hausnummer']," ",$row['Typ'].'</h3>';
	               // $_SESSION['hausobjektid']= $row['ObjektID'];
	           // }
	            
	    if(!empty($result_ort_plz)){
	        while($row = $result_ort_plz->fetch_assoc()){
	            echo '
	            <ul class="orte">
	            <li>'.$row['PLZ']," ", $row['Ort'].'</li>
	            </ul>
                ';
	        }
	    }
	    
	}else {
	   echo' <p></p>';
	}
	
	?>	
	</main>
	
<?php 
    require "footer.php";
?>