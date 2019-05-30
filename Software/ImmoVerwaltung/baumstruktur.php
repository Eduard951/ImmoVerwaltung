<?php
    //session_start();
    require "includes/dbh.inc.php";
    require "header.php";
?>

	<main>
	<?php 
	if(isset($_SESSION['sessionid'])){
	    
	    echo'<ul class="alle_orte">';
	    
	    $sql_orte="SELECT DISTINCT Ort,PLZ FROM hausobjekt GROUP BY Ort";
	    $sql_objekte ="SELECT Strasse, Hausnr, ObjektID FROM hausobjekt WHERE Ort=?;";
	    $sql_VEs ="SELECT verwaltungseinheit.VerwID,verwaltungseinheit.Typ,verwaltungseinheit.Kommentar FROM hausobjekt JOIN verwaltungseinheit ON verwaltungseinheit.ObjektID=hausobjekt.ObjektID WHERE hausobjekt.Strasse=? AND hausobjekt.Hausnr=?";
	    
	    $result = $conn->query($sql_orte);
	    
	    $stmt_strasse_nummer = mysqli_stmt_init($conn);
	    $stmt_VEs = mysqli_stmt_init($conn);
	    
	    if(!mysqli_stmt_prepare($stmt_strasse_nummer, $sql_objekte)||!mysqli_stmt_prepare($stmt_VEs, $sql_VEs)){
	        header("Location: ../index.php?error=sqlerror");
	        exit();
	    }else{
	    
	    if(!empty($result)){
	        while($row= $result->fetch_assoc()){
	            echo'<li><ul class="alle_objekte">'.$row['PLZ']." ".$row['Ort'];
                
                mysqli_stmt_bind_param($stmt_strasse_nummer, "s", $row['Ort']);
                
                mysqli_stmt_execute($stmt_strasse_nummer);
                
                $result_objekte = mysqli_stmt_get_result($stmt_strasse_nummer);
                
                if(!empty($result_objekte)){
                    while($row2=$result_objekte->fetch_assoc()){
                        echo'<li><form action="index.php" method="POST"><button type="submit"><input type="hidden" name="objektid" value="'.$row2['ObjektID'].'"/><ul class="VEs">'.$row2['Strasse']." ".$row2['Hausnr'].'</button></form>';
                        
                        mysqli_stmt_bind_param($stmt_VEs, "ss", $row2['Strasse'],$row2['Hausnr']);
                        
                        mysqli_stmt_execute($stmt_VEs);
                        
                        $result_VEs = mysqli_stmt_get_result($stmt_VEs);
                        
                        if(!empty($result_VEs)){
                            while($row3=$result_VEs->fetch_assoc()){
                                echo'<li><form action="index.php" method="POST"><button type="submit"><input type="hidden" name="objektid" value="'.$row3['VerwID'].'"/>'.$row3['Typ']." ".$row3['Kommentar'].'</button></form></li>';
                            }
                        }
                        echo'</ul></li>';
                    }
                }

               echo' </ul></li>';
	        }
	    }
	    
	    echo'</ul>';
	    }
	}else {
	   echo' <p></p>';
	}
	
	?>	
	</main>
	
<?php 
    require "footer.php";
?>
