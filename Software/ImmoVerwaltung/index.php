<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>


	<main>
	<?php 
	if(isset($_SESSION["sessionid"])){
	    
	  $id = $_POST['objektid'];
	  $_SESSION['objektid']=$id;
	  
	  //querys
	  $sql_hausobjekt = "SELECT * FROM hausobjekt JOIN verwaltungseinheit ON verwaltungseinheit.ObjektID=hausobjekt.ObjektID WHERE verwaltungseinheit.VerwID=?";
	  $sql_verwalter = "SELECT * FROM verwalter WHERE verwalter.BenutzerID =? AND ObjektID=?";
	  $sql_vermieter = "SELECT * FROM mietverhaeltnis WHERE mietverhaeltnis.Vermieter=? AND mietverhaeltnis.VerwID=?";
	  $sql_mieter = "SELECT * FROM mietverhaeltnis WHERE mietverhaeltnis.Mieter=? AND mietverhaeltnis.VerwID=?";
	    
	  //statements
	  $stmt_haus= mysqli_stmt_init($conn);
	  $stmt_verwalter=mysqli_stmt_init($conn);
	  $stmt_vermieter= mysqli_stmt_init($conn);
	  $stmt_mieter= mysqli_stmt_init($conn);
	  
	  
	  //hausobjekt holen
	  if(!mysqli_stmt_prepare($stmt_haus, $sql_hausobjekt)){
	      header("Location: baumstruktur.php?error=sqlerrorhaus");
	  }else{
	      mysqli_stmt_bind_param($stmt_haus, "i", $id);
	      
	      mysqli_stmt_execute($stmt_haus);
	      
	      $result_haus = mysqli_stmt_get_result($stmt_haus);
	      
	      if($row_haus=mysqli_fetch_assoc($result_haus)){
	          $objektid = $row_haus['ObjektID'];
	      }
	  }
	  
	  // verwalter
	  if(!mysqli_stmt_prepare($stmt_verwalter, $sql_verwalter)){
	      header("Location: /baumstruktur.php?error=sqlerrorverwalter");
	  }else{
	      mysqli_stmt_bind_param($stmt_verwalter, "ii", $_SESSION['sessionid'],$objektid);
	      
	      mysqli_stmt_execute($stmt_verwalter);
	      
	      $result_verwalter = mysqli_stmt_get_result($stmt_verwalter);
	      
	      
	  }
	  //vermieter
	  if(!mysqli_stmt_prepare($stmt_vermieter, $sql_vermieter)){
	      header("Location: /baumstruktur.php?error=sqlerrorvermieter");
	  }else{
	      mysqli_stmt_bind_param($stmt_vermieter, "ii", $_SESSION['sessionid'],$id);
	      
	      mysqli_stmt_execute($stmt_vermieter);
	      
	      $result_vermieter = mysqli_stmt_get_result($stmt_vermieter);
	      
	  }
	  //mieter
	  if(!mysqli_stmt_prepare($stmt_mieter, $sql_mieter)){
	      header("Location: /baumstruktur.php?error=sqlerrormieter");
	  }else{
	      mysqli_stmt_bind_param($stmt_mieter, "ii", $_SESSION['sessionid'],$id);
	      
	      mysqli_stmt_execute($stmt_mieter);
	      
	      $result_mieter = mysqli_stmt_get_result($stmt_mieter);
	      
	  }
	      
	      if(!empty($result_verwalter)&& mysqli_num_rows($result_verwalter)>0){
	          echo'
                <br><a href="versammlung_uebersicht.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="reparatur_submit">Eigentuemerversammlung</button>
                <br><a href="gruesse.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="gruesse_submit">Gruesse</button>
                <br><a href="add_hausobjekt.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="ho_submit">Hausobjekt hinzufügen</button>
                <br><a href="add_verwaltungseinheit.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="ve_submit">Verwaltungseinheit hinzufügen</button>
                <br><a href="add_zimmer.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="ve_submit">Zimmer und Rauchmelder hinzufügen</button>
                <br><a href="add_mietverhaeltnis.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="mv_submit">Mietverhältnis hinzufügen</button>
                <br><a href="nebenkostenabrechnung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="nka_submit">Nebenkostenabrechnung</button>
                <br><a href="UrteilSammlung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="UrteilSammlung_submit">Urteilsammlung</button>
                <br><a href="handwerkerverwaltung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="handwerkerverwaltung_submit">Handwerkerverwaltung</button>
                <br><a href="Datenschutzauskunft.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="Datenschutzauskunft_submit">Meine Daten</button>
                <br><a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button>
';
	      }else if(!empty($result_vermieter)&& mysqli_num_rows($result_vermieter)>0){
	              echo'
                <br><a href="gruesse.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="gruesse_submit">Gruesse</button>
                <br><a href="kuendigung_bestaetigung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="kuendigung_submit">Kuendigungbestaetigung</button>
                <br><a href="add_mietverhaeltnis.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="mv_submit">Mietverhältnis hinzufügen</button>
                <br><a href="nebenkostenabrechnung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="nka_submit">Nebenkostenabrechnung</button>
                <br><a href="UrteilSammlung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="UrteilSammlung_submit">Urteilsammlung</button>
                <br><a href="handwerkerverwaltung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="handwerkerverwaltung_submit">Handwerkerverwaltung</button>
                <br><a href="rauchmelderprotokoll.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="rauchmelderprotokoll_submit">Rauchmelderprotokoll</button>
                 <br><a href="Datenschutzauskunft.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="Datenschutzauskunft_submit">Meine Daten</button>
                <br><a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button>
';
	      }else if(!empty($result_mieter)&& mysqli_num_rows($result_mieter)>0){
	                  echo'<br><a href="reparatur.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="reparatur_submit">Reparatur/Beschwerdeeinrichtung</button>
                            <br><a href="vermieterinformation.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="info_submit">Vermieter Kontaktinformation</button>
                            <br><a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button>
                             <br><a href="Datenschutzauskunft.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="Datenschutzauskunft_submit"> Meine Daten</button>
';    
	              }else{
	                  echo'<br><a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button>';
	              }
	          
	      
	      
	  
	  
	  
	    /*
	    echo '<br><a href="gruesse.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="gruesse_submit">Gruesse</button>
              <br><a href="reparatur.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="reparatur_submit">Reparatur/Beschwerdeeinrichtung</button>
              <br><a href="versammlung_uebersicht.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="reparatur_submit">Eigentuemerversammlung</button>
              <br><a href="kuendigung_bestaetigung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="kuendigung_submit">Kuendigungbestaetigung</button>
              <br><a href="handwerkerverwaltung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="handwerkerverwaltung_submit">Handwerkerverwaltung</button>
              <br><a href="rauchmelderprotokoll.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="rauchmelderprotokoll_submit">Rauchmelderprotokoll</button>
              <br><a href="UrteilSammlung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="UrteilSammlung_submit">Urteilsammlung</button>
              <br><a href="add_hausobjekt.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="ho_submit">Hausobjekt hinzufügen</button>
              <br><a href="add_verwaltungseinheit.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="ve_submit">Verwaltungseinheit hinzufügen</button>
              <br><a href="add_mietverhaeltnis.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="mv_submit">Mietverhältnis hinzufügen</button>
              <br><a href="nebenkostenabrechnung.php"><button class="btn btn-primary btn-lg btn-block" type="submit" name="nka_submit">Nebenkostenabrechnung</button>

              <br><a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button>
               
'.$_SESSION['objektid'].'
';
*/
	}else {
	   echo' <p></p>';
	}
	?>	
	</main>
	
<?php 
    require "footer.php";
?>
