
<?php

$servername="localhost";
$dBusername ="root";
$dBpassword="";
$dBname="immoverwaltung";

$conn = mysqli_connect($servername,$dBusername,$dBpassword,$dBname);

if(!$conn){
    die("Connection failed!". mysqli_connect_error());
}
?>


<?php
if(isset($_POST["oui"]))
{
    $oui=$_POST["oui"];
    $stmt = $conn->prepare("INSERT INTO kategorie (Name) VALUES (?)");
    $stmt->bind_param("s",$oui);
  
   
    $stmt->execute();
   // $sql=" INSERT INTO kategorie (Name) VALUES('$oui ')";
   //mysqli_query($conn, $sql);
   
   
 //  header("Location:..//handwerkerverwaltung.php?add=succes");
   
    echo "kategorie added";
 
   
   
     
      
}
/*if(isset($_POST["del"]))
{
    
    
    $del=$_POST["del"];
    $stmt = $conn->prepare("DELETE FROM kategorie WHERE kategorie.Name = ?;");
    $stmt->bind_param("s",$del);
    
    
    $stmt->execute();
    echo "kategorie geloescht";
   // $sql="DELETE FROM kategorie WHERE kategorie.Name = '$del';";
  //  mysqli_query($conn, $sql);
  
     <input type="text" name="del">
        <button type="submit" name="delate"> delate</button>
  
    
}*/

if(isset($_POST["dela"]))
{
    
    
    $d=$_POST["checkbox"];
    foreach ($d as $id){
       
        $stmt = $conn->prepare("DELETE FROM kategorie WHERE kategorie.KategorieId = ?;");
        $stmt->bind_param("i",$id);
        
        
        $stmt->execute();
    }
    header("Location:..//handwerkerverwaltung.php");
    
    
    // $sql="DELETE FROM kategorie WHERE kategorie.Name = '$del';";
    //  mysqli_query($conn, $sql);
    
    
    
    
}
//$sql1= " INSERT INTO handwerkerverwaltung (HandwerkerId,KategorieId ,Aufgabebeschreibung,Kommentar,HausId) VALUES ('2','1','bonjour','handwerker_kommentar','2')";
//mysqli_query($conn, $sql1);
//$sql3= " INSERT INTO handwerkerverwaltung (HandwerkerId,KategorieId ,Aufgabebeschreibung,Kommentar,HausId) VALUES ('2','15','nouveau ','kommentar','1')";
//mysqli_query($conn, $sql3);

if(isset($_POST["sup"] ))
{
    $handwerker_name=$_POST["handwerker"];
    $handwerker_kategorie=$_POST["kategorie"];
    $handwerker_kommentar=$_POST["kommentar"];
    $handwerker_beschreibung=$_POST["beschreibung"];
    $handwerker_haus=$_POST["haus"];
    
    $sql = "insert into handwerkerverwaltung (hv.HandwerkerId,hv.KategorieId ,hv.Aufgabebeschreibung,hv.Kommentar,hv.HausId)
    SELECT h.HandwerkerID,k.KategorieId,'$handwerker_beschreibung','$handwerker_kommentar',ho.Adresse
    
     FROM handwerkerverwaltung AS hv INNER JOIN handwerker AS h
        
        on hv.HandwerkerId=h.HandwerkerID INNER JOIN kategorie AS k
        
        ON hv.KategorieId=k.KategorieId INNER join hausobjekt as ho
 where h.HandwerkerID IN(SELECT h.HandwerkerID FROM handwerker WHERE h.Name='$handwerker_name') and
    k.KategorieId IN( SELECT k.KategorieId FROM kategorie WHERE k.Name='$handwerker_kategorie')  and
    ho.Adresse IN ( SELECT ho.Adresse FROM hausobjekt WHERE ho.Adresse=$handwerker_haus )


";
   
    
   
    mysqli_query($conn, $sql);
    
    
    
    
    echo"done ";
   
    
    }
   
    //header("Location:..//handwerkerverwaltung.php");
    
    // $sql="DELETE FROM kategorie WHERE kategorie.Name = '$del';";
    //  mysqli_query($conn, $sql);
    
    
    
    


?>