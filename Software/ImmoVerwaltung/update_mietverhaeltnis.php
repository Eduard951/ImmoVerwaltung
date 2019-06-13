<?php
    require 'header.php';
    require 'includes/dbh.inc.php';
    
    if(isset($_SESSION['sessionid'])){
        
        $session_verwID = $_SESSION['objektid'];
        $session_benutzerID = $_SESSION['sessionid'];
        
        $mietverhaeltnis_sql = "SELECT * FROM mietverhaeltnis WHERE VerwID = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $mietverhaeltnis_sql)){
            header("Location: ../update_mietverhaeltnis.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "i", $session_verwID);
            mysqli_stmt_execute($stmt);
            $result_mietverhaeltnis = mysqli_stmt_get_result($stmt);
            if($row=mysqli_fetch_assoc($result_mietverhaeltnis)){
                $mv_mieter = $row['Mieter'];
                $mv_beginn = $row['Beginn'];
                $mv_ende = $row['Ende'];
                
            }
                $mieter_sql = "SELECT * FROM benutzer WHERE BenutzerID = ?";
                if(!mysqli_stmt_prepare($stmt, $mieter_sql)){
                    header("Location: ../update_mietverhaeltnis.php?mieter_error=sqlerror");
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "i", $mv_mieter);
                    mysqli_stmt_execute($stmt);
                    $result_mieter = mysqli_stmt_get_result($stmt);
                    if($row=mysqli_fetch_assoc($result_mieter)){
                        $mv_mieter_vorname = $row['Vorname'];
                        $mv_mieter_name = $row['Name'];
                    }
                    mysqli_stmt_bind_param($stmt, "i", $session_benutzerID);
                    mysqli_stmt_execute($stmt);
                    $result_vermieter = mysqli_stmt_get_result($stmt);
                    if($row=mysqli_fetch_assoc($result_vermieter)){
                        $mv_vermieter_vorname = $row['Vorname'];
                        $mv_vermieter_name = $row['Name'];
                    }
                }
        
        }
 
    ?>

<!-- Mietverhältnis Formular -->
<h2>Mietverhältnis bearbeiten</h2>
<form enctype="multipart/form-data" action="includes/update.inc.php" method="post">
	<p>
        <label>Verwaltungseinheit:</label>
        <input type="text" name="mv_verwaltungseinheit" value="<?php echo $session_verwID; ?>" readonly>
    </p>
    <p>
    	<label>Vermieter: <?php echo $mv_vermieter_vorname." ".$mv_vermieter_name; ?></label>
      	<input type="hidden" name="mv_vermieter" value="<?php echo $session_benutzerID; ?>" readonly> 
    </p>
	 <p>
    	<label>Mieter: <?php echo $mv_mieter_vorname." ".$mv_mieter_name; ?></label>
      	<input type="hidden" name="mv_mieter" value="<?php echo $mv_mieter; ?>" readonly> 
    </p>
    <p>
        <label>Beginn:</label>
        <input type="date" name="mv_beginn" value="<?php echo $mv_beginn; ?>">
    </p>
    <p>
        <label>Ende:</label>
        <input type="date" name="mv_ende" value="<?php echo $mv_ende; ?>">
    </p>  
    <button class="btn btn-secondary btn-lg" type="submit" name="mietverhaeltnis_update_submit">Mietverhältnis aktualisieren</button>
</form>

<?php }

?>