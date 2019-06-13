<?php
require "header.php";

require "includes/dbh.inc.php";

$sql="SELECT * FROM zahlungen JOIN zahlungskonto ON zahlungen.ZahlungsKontoID=zahlungskonto.ZahlungsKontoID JOIN mietverhaeltnis ON mietverhaeltnis.mietverhaeltnisID=zahlungskonto.MietverhaeltnisID WHERE mietverhaeltnis.Vermieter=?";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../gruesse.php?error=sqlerror");
    exit();
}else{
    
    $id = $_SESSION['sessionid'];
    
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    mysqli_stmt_execute($stmt);
    $betrag=0;
    $result = mysqli_stmt_get_result($stmt);
    echo'<h4>Konto:</h4><br><h5>Betraege:</h5>';
    while($row=mysqli_fetch_assoc($result)){
        $saldo=$row['Betrag'];
        $text =$row['Text'];
        $betrag+=$saldo;
        echo $text.' +'.$saldo.'';
    }
    echo'<br><h5>Saldo:</h5><br>'.$betrag.' Euro.<br>';
    echo'<br><a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button>';
}
