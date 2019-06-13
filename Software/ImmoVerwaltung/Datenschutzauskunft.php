<?php

require "header.php";
require "includes/dbh.inc.php";


?>
<?php  
session_start();
if(isset($_SESSION['sessionid'])){
 echo" <div class='container'>";  

    echo' <form   method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
<div class="row"><h3 col-md-offset-2 col-md-5> Meine Daten </h3></br></div>';
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
    echo '<div class="row">';
   echo' <table class="table table-bordered table-striped table-condensed col-md-offset-2 col-md-5">';
  
   echo '<tbody>';
   echo '<tr>';
   echo "<td>"."Name:" ."</td>". "<td>"."$vorname"." </td>";
   echo '</tr>';
   echo '<tr>';
   echo "<td>"."Nachame:" ."</td>". "<td>"."$nachname"." </td>";
   echo '</tr>';
   echo '<tr>';
   echo "<td>"."Postleitzahl:" ."</td>". "<td>"."$plz"." </td>";
   echo '</tr>';
   echo '<tr>';
  echo "<td>"."Ort:" ."</td>". "<td>"."$ort"." </td>";
  echo '</tr>';
  echo '<tr>';
   echo "<td>"."Srasse:" ."</td>". "<td>"."$strasse"." </td>";
   echo '</tr>';
   echo '<tr>';
  echo "<td>"."Hausnummer:" ."</td>". "<td>"."$hausnummer"." </td>";
  echo '</tr>';
  echo '<tr>';
  echo "<td>"."E-Mail:" ."</td>". "<td>"."$email"." </td>";
  echo '</tr>';
     echo '</table>';
     echo '</div>';
}

echo'</form>';
echo'</div>';
}
?>