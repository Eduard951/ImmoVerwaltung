<?php
require ('dbh.inc.php');
?>

<?php
if(isset($_POST["submit"])  )
{
    $name=$_POST["oui"];
    $text=$_POST["beschreibung"];
    if (empty($name) || empty($text)){
        echo "Bitte fuellen sie die Felder";
    }else {
        
    
    
    $stmt = $conn->prepare("INSERT INTO urteilsammlung (Stichwort,Text) VALUES (?,?)");
    $stmt->bind_param("ss",$name,$text);
  
   
    $stmt->execute();
    echo 'Urteil  added';}
}


if(isset($_POST["submitt"]) )
{
    $p=$_POST["non"];
    $query=mysqli_query($conn," select * from urteilsammlung where stichwort='$p'");
    
  //  $sql=" select * from urteilsammlung where Name=' $p' ";
  
   
    while ($row=mysqli_fetch_array($query ) )
    {
        echo $row["Text"]    ;
       
        
    }
    
    
    
   
}


?>

