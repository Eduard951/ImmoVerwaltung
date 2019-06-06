
<?php

$servername="localhost";
$dBusername ="propra1";
$dBpassword="FelixEduardFrancisOli.123";
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
    $stmt = $conn->prepare("INSERT INTO handwerker_kategorie (Name) VALUES (?)");
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
       
        $stmt = $conn->prepare("DELETE FROM handwerker_kategorie WHERE handwerker_kategorie.KategorieID = ?;");
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
    
    if (empty($handwerker_name) || empty( $handwerker_kategorie) || empty( $handwerker_kommentar) || empty( $handwerker_beschreibung) || empty(  $handwerker_haus)){
        echo "Bitte fuellen sie alle  Felder";
        
    }else {
    $query=mysqli_query($conn," select * from handwerker where Name='$handwerker_name'");
    
    while ($row=mysqli_fetch_array($query ) )
    {
        $H= $row["HandwerkerID"]    ;
        
    }
    
    $query1=mysqli_query($conn," select * from handwerker_kategorie where Name='$handwerker_kategorie");
    
    
    while ($row=mysqli_fetch_array($query1 ) )
    {
        $K= $row["KategorieID"]    ;
        
        
    }
    
    $query2=mysqli_query($conn," select * from hausobjekt where ObjektID='$handwerker_haus'");
    

    while ($row=mysqli_fetch_array($query2 ) )
    {
        $O= $row["ObjektID"]    ;
        
        
    }
    
    
    $sql = "insert into handwerkerverwaltung (HandwerkerID,KategorieID ,ObjektID,Aufgabebeschreibung,Kommentar)
   values($H,$K,$O,$handwerker_beschreibung, $handwerker_kommentar)

";
   
    
   
    mysqli_query($conn, $sql);
    
    
    
    
    echo"done ";
   echo "$H";
        echo "$O";
        echo "$K";
    }
    }
   
    //header("Location:..//handwerkerverwaltung.php");
    
    // $sql="DELETE FROM kategorie WHERE kategorie.Name = '$del';";
    //  mysqli_query($conn, $sql);
    
    
    
