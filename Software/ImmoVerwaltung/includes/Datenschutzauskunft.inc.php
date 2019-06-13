<?php
require ('dbh.inc.php');
session_start();
?>

<?php



if(isset($_POST["submi"])) {
    
    $id=$_SESSION['sessionid'];
   $m= $_SESSION['sessionmail'];
    
    $query=mysqli_query($conn," select * from benutzer WHERE Email=' $m'");
    
    while ($row=mysqli_fetch_array($query ) )
    {
        $H= $row["Name"]    ;
        
    }
    
  /*  $sql = "SELECT * FROM benutzer WHERE BenuzterID=?;";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($row=mysqli_fetch_assoc($result)){
            $n=$row["Name"];
            $v=$row["Vorame"];
            $s=$row["Strasse"];
            $h=$row["Hausnr"];
            $p=$row["PLZ"];
            $o=$row["Ort"];  
         

        }
        */
       /* echo "<h4> Name:</h4>".$n." <br>";
        echo "<h4> Vorname:</h4>".$v." <br>";
        echo "<h4> E-Mail:</h4> ". $_SESSION["sessionmail"]." <br>";
   echo "<h4> Adresse:</h4> ".$s.$h.$p.$o."<br>";*/
    
    echo "meine";
    echo" $id";
    echo "$m";
}
//}
     
    ?>