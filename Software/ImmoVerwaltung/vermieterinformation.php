<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>

<main>
	<?php 
	
	$sql_vermieterinfo ="SELECT * FROM benutzer JOIN mietverhaeltnis ON mietverhaeltnis.Vermieter = benutzer.BenutzerID WHERE mietverhaeltnis.Mieter=?";
	
	$stmt_vermieter_info= mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($stmt_vermieter_info, $sql_vermieterinfo)){
	    header("Location: ../index.php?error=sqlerrorvermieterinfo");
	    exit();
	}else{
	    
	    mysqli_stmt_bind_param($stmt_vermieter_info, "i", $_SESSION['sessionid']);
	    mysqli_stmt_execute($stmt_vermieter_info);
	    $result_vermieter_info = mysqli_stmt_get_result($stmt_vermieter_info);
	}
	
	if(isset($_SESSION['sessionid'])){
	    echo '
		<h2>Vermieterinformation<span class="badge badge-secondary"></span></h2>';
        
	    if(!empty($result_vermieter_info)){
	        while($row_vermieter_info = $result_vermieter_info->fetch_assoc()){
	            echo '<br><h5>E-Mail: </h5> <h6>'.$row_vermieter_info['Email'].'</h6>
                      <br>    <h5>Name: </h5> <h6>'.$row_vermieter_info['Name'].'</h6>
                      <br>    <h5>Vorname: </h5> <h6>'.$row_vermieter_info['Vorname'].'</h6>
	                
                    ';
	        }
	    }
		
       echo' <br><a href="index.php"><button class="btn btn-primary btn-lg">Zurueck</button>
';
	}else {
	   echo'';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>
