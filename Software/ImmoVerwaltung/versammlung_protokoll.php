<?php
    require "header.php";
    require "includes/dbh.inc.php";
?>

<main>

	<?php
	
	if(isset($_POST['protokoll_suchen'])){
	    $datum = $_POST['vers_datum'];
	    
	    if(!empty($datum)){
	        
	        $sql_select_versammlung="SELECT eigen_vers.VersammlungID,eigen_vers.Datum,ev_protokoll.Protokoll_ID,ev_protokoll_header.VerwalterID,ev_protokoll_header.Ort,ev_protokoll_header.Jahr,ev_protokoll_header.Startzeit,ev_protokoll_header.Endzeit FROM eigen_vers JOIN ev_protokoll ON eigen_vers.VersammlungID=ev_protokoll.VersammlungID JOIN ev_protokoll_header ON ev_protokoll_header.Protokoll_ID=ev_protokoll.Protokoll_ID WHERE eigen_vers.ObjektID=? AND eigen_vers.Datum=?";
	        $sql_hausobjekt = "SELECT verwaltungseinheit.ObjektID FROM verwaltungseinheit WHERE VerwID=?";
	        $sql_baustein = "SELECT * FROM ev_protokoll_baustein WHERE ev_protokoll_baustein.Protokoll_ID=?";
	        $sql_bfk = "SELECT * FROM ev_protokoll_baustein JOIN ev_beschlussfaehigkeit ON ev_protokoll_baustein.BausteinID=ev_beschlussfaehigkeit.BausteinID JOIN benutzer ON benutzer.BenutzerID=ev_beschlussfaehigkeit.BenutzerID WHERE ev_protokoll_baustein.BausteinID=?";
	        $sql_beschluesse = "SELECT * FROM ev_protokoll_baustein JOIN ev_beschluesse ON ev_protokoll_baustein.BausteinID=ev_beschluesse.BausteinID WHERE ev_protokoll_baustein.BausteinID=?";
	        
	        $stmt_select_versammlung=mysqli_stmt_init($conn);
	        $stmt_hausobjekt=mysqli_stmt_init($conn);
	        $stmt_baustein=mysqli_stmt_init($conn);
	        $stmt_bfk = mysqli_stmt_init($conn);
	        $stmt_beschluesse = mysqli_stmt_init($conn);
	        
	        
	        ///////////////
	        //hausobjekt
	        //////////////
	        if(!mysqli_stmt_prepare($stmt_hausobjekt, $sql_hausobjekt)){
	            header("Location: ../versammlung_protokoll_suche.php?error=sqlerror");
	            exit();
	        }else{
	            mysqli_stmt_bind_param($stmt_hausobjekt, "i", $_SESSION['objektid']);
	            
	            mysqli_stmt_execute($stmt_hausobjekt);
	            
	            $result_hausobjekt = mysqli_stmt_get_result($stmt_hausobjekt);
	            
	            if($row_hausobjekt=mysqli_fetch_assoc($result_hausobjekt)){
	                
	                $hausobjektid= $row_hausobjekt['ObjektID'];
	                
	            }else{
	                header("Location: versammlung_protokoll_suche.php?error=sqlerrorhausobjekt");
	                exit();
	            }
	            
	        }
	        
	        /////////////
	        //versammlung
	        /////////////
	        if(!mysqli_stmt_prepare($stmt_select_versammlung, $sql_select_versammlung)){
	            header("Location: versammlung_protokoll_suche.php?error=sqlerror");
	            exit();
	        }else{
	            mysqli_stmt_bind_param($stmt_select_versammlung, "is", $hausobjektid,$datum);
	            
	            mysqli_stmt_execute($stmt_select_versammlung);
	            
	            $result_versammlung = mysqli_stmt_get_result($stmt_select_versammlung);
	            
	            if($row_vers=mysqli_fetch_assoc($result_versammlung)){
	                
	                $versammlungid=$row_vers['VersammlungID'];
	                $datum=$row_vers['Datum'];
	                $protokollid=$row_vers['Protokoll_ID'];
	                $verwalterid=$row_vers['VerwalterID'];
	                $ort=$row_vers['Ort'];
	                $jahr=$row_vers['Jahr'];
	                $start=$row_vers['Startzeit'];
	                $ende=$row_vers['Endzeit'];
	                
	            }else{
	                header("Location: versammlung_protokoll_suche.php?error=sqlerrorversammlung");
	                exit();
	            }
	        
	            //ECHOS
	           echo'
            <form action="includes/abschlussprotokoll.inc.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Beginn:</label>
                    <input name="beginn" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="'.$datum." ".$start.'" value="'.$datum." ".$start." Uhr".'">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ort:</label>
                    <input name="ort" type="text" class="form-control" id="" placeholder="" value="'.$ort.'">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ende:</label>
                    <input name="ende" type="text" class="form-control" id="" placeholder="" value="'.$datum." ".$ende." Uhr".'">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Leiter:</label>
                    <input name="leiter" type="text" class="form-control" id="" placeholder="" value="'.$verwalterid.'">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Protokollfuehrer:</label>
                    <input name="protokollfuehrer" type="text" class="form-control" id="" placeholder="" value="'.$verwalterid.'">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Verwaltungsbeirat:</label>
                    <input name="verwaltungsbeirat" type="text" class="form-control" id="" placeholder="">
                </div>
<br>';
	           
	           ///////////////
	           //bausteine
	           //////////////
	           if(!mysqli_stmt_prepare($stmt_baustein, $sql_baustein)){
	               header("Location: ../versammlung_protokoll_suche.php?error=sqlerror");
	               exit();
	           }else{
	               mysqli_stmt_bind_param($stmt_baustein, "i", $protokollid);
	               
	               mysqli_stmt_execute($stmt_baustein);
	               
	               $result_baustein = mysqli_stmt_get_result($stmt_baustein);
	               
	               if(!empty($result_baustein)){
	                   while($row_baustein = $result_baustein->fetch_assoc()){
	                       
	                       $bausteinid = $row_baustein['BausteinID'];
	                       $text=$row_baustein['Text'];
	                       $nr=$row_baustein['Nr'];
	                       $topic=$row_baustein['Ueberschrift'];
	                       $beschlussfk=$row_baustein['BeschlussfkID'];
	                       $beschluesse=$row_baustein['BeschluesseID'];
	                       
	                       if($beschlussfk===0 && $beschluesse===0){
	                           
	                       echo'<style>
                                table, th, td {
                                  border: 1px solid black;
                                  font-weight:normal;
                                }
                                    th, td {
                                      padding: 15px;
                                    }
                                </style>
                            
                            <div><h4 name="top_freitext" >TOP: '.$nr." ".$topic.'</h4>
                            <textarea name="freitext" class="form-control" rows="3" type="text" value="'.$text.'">'.$text.'</textarea>
                            </div>';
	                       }else if($beschlussfk===1 && $beschluesse===0){
	                           
	                           if(!mysqli_stmt_prepare($stmt_bfk, $sql_bfk)){
	                               header("Location: ../versammlung_protokoll_suche.php?error=sqlerror");
	                               exit();
	                           }else{
	                               
	                               mysqli_stmt_bind_param($stmt_bfk, "i", $bausteinid);
	                               
	                               mysqli_stmt_execute($stmt_bfk);
	                               
	                               echo'
                         <br>
                        <div><h4>TOP: '.$nr." ".$topic.'</h4>
                         <table style="width:100%">
                              <tr>
                                <th>Wohnungsnr/Beschreibung Eigentuemer</th>
                                <th>Anteil</th>
                                <th>Anwesend</th>
                                <th>Stimmenanteile</th>
                              </tr>';
	                               
	                               $result_bfk = mysqli_stmt_get_result($stmt_bfk);
	                               if(!empty($result_bfk)){
	                                   while($row_bfk = $result_bfk->fetch_assoc()){
	                                       $vorname= $row_bfk['Vorname'];
	                                       $nachname= $row_bfk['Name'];
	                                       $kommentar= $row_bfk['Kommentar'];
	                                       $anwesend= $row_bfk['Anwesend'];
	                                       echo'<tr>
                                                    <td><input type="text" name="personen_bfk[] value="'.$vorname." ".$nachname.'">'.$vorname." ".$nachname.'</td>
                                                    <td><input type="text" name="anteil[]"></td>
                                                    <td><input name="anwesend[]" type="text" value="'.$anwesend.'"></input></td>
                                                    <td><input name="stimmenanteile[]" type="text"></input></td>
                                                </tr>';
	                                   }
	                               }
	                           }
	                           
	                       echo'
                            <tr><td>Summe: </td><td>1000</td><td></td><td><input name="stimmenanteile_gesamt" type="text"></input></td></tr>
                            </table>
                            <br><textarea name="text_bfk" class="form-control" rows="1" type="text" value="'.$text.'">'.$text.'</textarea>
';
	                       }else if($beschlussfk===0 && $beschluesse===1){
	                           
	                           if(!mysqli_stmt_prepare($stmt_beschluesse, $sql_beschluesse)){
	                               header("Location: ../versammlung_protokoll_suche.php?error=sqlerrorbeschluesse");
	                               exit();
	                           }else{
	                               
	                               mysqli_stmt_bind_param($stmt_beschluesse, "i", $bausteinid);
	                               
	                               mysqli_stmt_execute($stmt_beschluesse);
	                               $result_beschluesse = mysqli_stmt_get_result($stmt_beschluesse);
	                               
	                               if($row_beschluesse=mysqli_fetch_assoc($result_beschluesse)){
	                               
	                                   $ueberschrift_beschluesse = $row_beschluesse['Ueberschrift'];
	                                   $abst_typ = $row_beschluesse['Abst_Typ'];
	                                   $regel = $row_beschluesse['Regel'];
	                                   $bausteinid_beschluesse = $row_beschluesse['BausteinID'];
	                                   $text_beschluesse = $row_beschluesse['Text'];
                        echo'
                         <br><br>
                        <div><h4>TOP: '.$nr." ".$topic." ".$ueberschrift_beschluesse.'</h4>
                         <table style="width:100%">
                              <tr>
                                <th>Beschluss</th>
                                <th><textarea name="beschluss" class="form-control" rows="2" type="text" value="'.$text_beschluesse.'">'.$text_beschluesse.'</textarea></th> 
                              </tr>
                              <tr>
                                <td>Abstimmung</td>
                                <td><input name="abstimmungstyp" type="text" value="z.B. offen"></input></td>
                              </tr>
                              <tr>
                                <td>Beschlussregel</td>
                                <td><select name="beschlussregel" ><option value="einfache Mehrheit">einfache Mehrheit</option><option value="x% Mehrheit">x% Mehrheit</option></select></td>
                              </tr>
                              <tr>
                                <td>Abstimmungsergebnis</td>
                                <td>Ja: <input name="ja" type="text"></input><br>Nein: <input name="nein" type="text"></input><br>Enthaltungen: <input name="enthaltungen" type="text"></input></td>
                              </tr>                              
                            </table>  
                            <br><textarea name="beschluss_text" class="form-control" rows="3" type="text" value=""></textarea>


                            ';
	                               }
	                       }
	                       }
	                       
	                   }
	                   
	                   
	               }else{
	                   header("Location: versammlung_protokoll_suche.php?error=sqlerrorhausobjekt");
	                   exit();
	               }
	               
	           }



                echo'<br><br><button name="protokoll_submit" type="submit" class="btn btn-primary">Speichern</button>
            </form>
                ';
	            
	            
	            echo'<br><a href="versammlung_protokoll_suche.php"><button class="btn btn-primary btn-lg">Zurueck</button>';        
	        }
	     }else{
	        header("Location: versammlung_protokoll_suche.php?error=emptyfields");
	        exit();
	    }
	    
	    //Final Protokoll versenden
	    
	}
	
	?>
	
</main>

<?php 
    require "footer.php";
?>






