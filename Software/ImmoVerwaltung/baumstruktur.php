<?php
    //session_start();
    require "includes/dbh.inc.php";
    require "header.php";
?>

	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    $strasse_nummer = "SELECT Strasse,Hausnummer FROM adresse WHERE Ort = ? AND Plz = ?;";
	    $ort_plz = "SELECT Ort,Plz FROM adresse GROUP BY Ort;";
	    $sql = "SELECT adresse.Ort,adresse.PLZ,adresse.Strasse, adresse.Hausnummer,hausobjekt.Typ, hausobjekt.ObjektID FROM hausobjekt JOIN adresse ON hausobjekt.Adresse=adresse.AdresseID;";
	    $result = $conn->query($sql);
	    $result_ort_plz = $conn->query($sql);
	    
	    
	    
	    $stmt_strasse_nummer = mysqli_stmt_init($conn);
	    
	    if(!mysqli_stmt_prepare($stmt_strasse_nummer, $strasse_nummer)){
	        header("Location: ../index.php?error=sqlerror");
	        exit();
	    }else{
	        
	           //if (!empty($result)) {
	           // while($row = $result->fetch_assoc()) {
	                
	               // echo '
                   // <br><h3><a href="index.php">'.$row['Ort']," " ,$row['PLZ']," ",$row['Strasse']," ",$row['Hausnummer']," ",$row['Typ'].'</h3>';
	               // $_SESSION['hausobjektid']= $row['ObjektID'];
	           // }
	            
	    if(!empty($result_ort_plz)){
	        while($row = $result_ort_plz->fetch_assoc()){
	            
	            mysqli_stmt_bind_param($stmt_strasse_nummer, "ss",$row['Ort'], $row['PLZ']);
	            mysqli_stmt_execute($stmt_strasse_nummer);
	            $result_strasse_nummer = mysqli_stmt_get_result($stmt_strasse_nummer);
	            
	            echo '
	            <ul class="orte">
	               <ul><a href="">'.$row['PLZ']," ", $row['Ort'].'</ul>';
	                
	               if(!empty($result_strasse_nummer)){
	                   while($row2 = $result_strasse_nummer->fetch_assoc()){
                        echo'<li><a href="index.php">'.$row2['Strasse']." ".$row2['Hausnummer'].'</li>';
	                   }
	            }
	            echo'
	            </ul>
                ';
	        }
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