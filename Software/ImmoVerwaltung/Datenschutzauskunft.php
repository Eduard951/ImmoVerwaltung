<?php

require "header.php";
require "includes/dbh.inc.php";


?>
<?php  
session_start();
if(isset($_SESSION['sessionid'])){
   

    echo' <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<h3> Meine Daten Ansehen</h3></br>';
//echo' <button type="submit" class="btn btn-success" name="submi "> </button>';
     


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
        $email = $row['Email'];
    }
    echo "Name:" . "$vorname"." <br>";
    echo "Vorname:" ."$nachname" ."<br>" ;
    echo "Postleitzahl:" ."$plz" ."<br>";
    echo "Ort:" ."$ort" ."<br>";
    echo "Strasse:" ."$strasse" ."<br>";
    echo "Hausnummer:" ."$hausnummer" ."<br>";
    echo "E-Mail:" ."$email" ."<br>";
     
}

echo'</form>';
    
}
?>