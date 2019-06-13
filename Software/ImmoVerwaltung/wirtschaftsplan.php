<?php
require "header.php";
require "includes/dbh.inc.php";
?>

<main>
<?php 

$sql_objekt= "SELECT hausobjekt.ObjektID FROM hausobjekt JOIN verwaltungseinheit ON verwaltungseinheit.ObjektID=hausobjekt.ObjektID WHERE verwaltungseinheit.VerwID=?";
$sql_wohnungen = "SELECT verwaltungseinheit.VS_Muell,verwaltungseinheit.VS_Aufzug,verwaltungseinheit.VS_Verwaltergebuehr,verwaltungseinheit.Kommentar,verwaltungseinheit.VS_Eigentumsanteil FROM verwaltungseinheit JOIN hausobjekt ON verwaltungseinheit.ObjektID=hausobjekt.ObjektID WHERE hausobjekt.ObjektID=?";

$stmt_objekt=mysqli_stmt_init($conn);
$stmt_wohnungen = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt_objekt, $sql_objekt)){
    header("Location: ../index.php?error=sqlerrorobjekt");
    exit();
}else{
    mysqli_stmt_bind_param($stmt_objekt, "i", $_SESSION['objektid']);
    mysqli_stmt_execute($stmt_objekt);
    $result_objekt = mysqli_stmt_get_result($stmt_objekt);
    
    if($row_objekt=mysqli_fetch_assoc($result_objekt)){
        
        $objektid = $row_objekt['ObjektID'];
        
    }
}

if(!mysqli_stmt_prepare($stmt_wohnungen, $sql_wohnungen)){
    header("Location: ../index.php?error=sqlerrorobjekt");
    exit();
}else{
    mysqli_stmt_bind_param($stmt_wohnungen, "i", $objektid);
    mysqli_stmt_execute($stmt_wohnungen);
    $result_VEs = mysqli_stmt_get_result($stmt_wohnungen);
    
    echo'<h2>Wirtschaftsplan</h2>
<form action="includes/nka.inc.php" method="post">
<table style="width:100%">
                <tr>
                
                <th>Art</th>
                <th>Gesamt</th>
                <th>Verteilungsschluessel</th>
                
        ';
    
    if(!empty($result_VEs)){
        
       $schluessel = array(); 
        
        while($row_ves= $result_VEs->fetch_assoc()){
        
        $ve=$row_ves['Kommentar'];
        $ve_muell=$row_ves['VS_Muell'];
        $ve_aufzug=$row_ves['VS_Aufzug'];
        $ve_anteil=$row_ves['VS_Eigentumsanteil'];
        $ve_gebuehr=$row_ves['VS_Verwaltergebuehr'];
        
        $single_schluessel = array($ve_muell,$ve_aufzug,$ve_anteil,$ve_gebuehr);
        
        array_push($schluessel, $single_schluessel);
        
            echo'
            
            <th><input type="hidden" name = "wohnungen[]" value="'.$ve.'">'."Wohnung:"." ".$ve.'</th>
            
            ';
        }
        $gesamt_muell=0;
        $gesamt_aufzug=0;
        $gesamt_anteil=0;
        $gesamt_verwalter=0;
        for($l=0;$l<count($schluessel);$l++){
            $gesamt_muell+= $schluessel[$l][0];
            $gesamt_aufzug+= $schluessel[$l][1];
            $gesamt_anteil+= $schluessel[$l][2];
            $gesamt_verwalter+= $schluessel[$l][3];
        }
        
        
            echo'</tr>
             <tr><td>Muellabfuhr</td><td><input name="muell_gesamt" type ="text" value="'.$gesamt_muell.'"></td><td><input name="schluessel_muell" type ="text" value="A" readonly></td>';for($k=0;$k<count($schluessel);$k++){echo'<td><input name="vs_muell[]" type="hidden" value="'.$schluessel[$k][0].'">'.$schluessel[$k][0].'</td>';}echo '</tr>';
            echo '<tr><td>Aufzugskosten</td><td><input name="aufzug_gesamt" type ="text" value="'.$gesamt_aufzug.'"></td><td><input name="schluessel_aufzug" type ="text" value="B" readonly></td>';for($k=0;$k<count($schluessel);$k++){echo'<td><input name="vs_aufzug[]" type="hidden" value="'.$schluessel[$k][1].'">'.$schluessel[$k][1].'</td>';}echo '</tr>';
             echo'<tr><td>Eigentumsanteile</td><td><input name="anteil_gesamt" type ="text" value="'.($gesamt_anteil*1000).'"></td><td><input name="schluessel_anteil" type ="text" value="C" readonly></td>';for($k=0;$k<count($schluessel);$k++){echo'<td><input name="vs_anteil[]" type="hidden" value="'.($schluessel[$k][2]*1000).'">'.($schluessel[$k][2]*1000).'</td>';}echo '</tr>';
             echo' <tr><td>Verwaltergebuehr</td><td><input name="verwalter_gesamt" type ="text" value="'.$gesamt_verwalter.'"></td><td><input name="schluessel_verwalter" type ="text" value="D" readonly></td>';for($k=0;$k<count($schluessel);$k++){echo'<td><input name="vs_verwalter[]" type="hidden" value="'.$schluessel[$k][3].'">'.$schluessel[$k][3].'</td>';}echo '</tr>';
             echo'<tr><td>Individuelle Abrechnung</td><td><input name="indiv_gesamt" type ="text" value="-"></td><td><input name="schluessel_indiv" type ="text" value="E" readonly></td>';for($k=0;$k<count($schluessel);$k++){echo'<td><input name="vs_indiv[]" type="hidden" value="">'."-".'</td>';}echo '</tr>';
echo'
<br>
            <tr>
            <th>Kosten</th></tr>
            <tr><td>Muellabfuhr</td><td><input type ="text" name="muellabfuhr_kosten_gesamt"></td><td><input name ="muellabfuhr_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Niederschlagswasser und Strassenreinigungsgebuehr</td><td><input type ="text" name="reinigung_kosten_gesamt"></td><td><input name ="reinigung_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Gebaeudeversicherung</td><td><input type ="text" name="versicherung_kosten_gesamt"></td><td><input name ="versicherung_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Haftpflichtversicherung</td><td><input type ="text" name="haftpflicht_kosten_gesamt"></td><td><input name ="haftpflicht_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Hausmeister</td><td><input type ="text" name="hausmeister_kosten_gesamt"></td><td><input name ="hausmeister_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Treppenhausreinigung</td><td><input type ="text" name="treppenhaus_kosten_gesamt"></td><td><input name ="treppenhaus_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Sonstige Bewirtschaftungskosten</td><td><input type ="text" name="sonstige_kosten_gesamt"></td><td><input name ="sonstige_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Wartung, TUEV Aufzug</td><td><input type ="text" name="aufzugwartung_kosten_gesamt"></td><td><input name ="aufzugwartung_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Allgemeinstrom</td><td><input type ="text" name="strom_kosten_gesamt"></td><td><input name ="strom_kosten_gesamt_key" type ="text"></td></tr>
            <tr><td>Heizkosten</td><td><input type ="text" name="heiz_kosten_gesamt"></td><td><input name ="heiz_kosten_gesamt_key" type ="text" value="E" readonly></td>';for($k=0;$k<count($schluessel);$k++){echo'<td><input name ="heizkosten[]" type="text"></input></td>';}echo'</tr>
                
            
            
<tr>
            <th>Wohngeldvorauszahlungen</th><td><input name="wohngeld_gesamt" type ="text"></td><td></td>';for($k=0;$k<count($schluessel);$k++){echo'<td><input name="wohngeld[]" type="text"></td>';}echo '</tr></table>';

            
echo'
<br><button class="btn btn-primary btn-lg" type="submit" name="nka_submit">Speichern</button><br></form>

<br><a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button>

                
';
            
            
        

    }
}

?>
</main>

<style>
table, th, td {
  border: 1px solid black;
}
</style>


<?php
require "footer.php";
?>
