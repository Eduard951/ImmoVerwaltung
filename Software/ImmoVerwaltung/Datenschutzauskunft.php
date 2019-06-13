<?php

require "header.php";
require "includes/dbh.inc.php";


?>
<?php  
session_start();
if(isset($_SESSION['sessionid'])){
   

    echo' <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<h3> Meine Daten Ansehen</h3></br>
<button type="submit" class="btn btn-success" name="submi "> </button>';
echo'';
     


$sql = "SELECT * FROM benutzer WHERE BenutzerID=?;";

$stmt = mysqli_stmt_init($conn);


if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../index.php?error=sqlerror");
    exit();
}else{
    
    $id = $_SESSION['sessionid'];
    
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    if($row=mysqli_fetch_assoc($result)){
        
        $vorname = $row['Vorname'];
        $nachname = $row['Name'];
        $strasse = $row['Strasse'];
        $ort = $row['Ort'];
        $plz = $row['PLZ'];
        $hausnummer = $row['Hausnr'];
    }
    echo "$vorname";
    echo "$nachname";
    echo "$strasse";
    echo "$ort";
    echo "$plz";
    echo "$hausnummer";
    echo "oui";
     
}

echo'</form>';
    
}
?>