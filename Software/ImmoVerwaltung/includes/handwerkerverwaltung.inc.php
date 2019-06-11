
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
 
   
    echo "kategorie added";
 
   
   
     
      
}

if(isset($_POST["sus"]))
{
    $oui=$_POST["sus"];
    $stmt = $conn->prepare("INSERT INTO handwerker (Name) VALUES (?)");
    $stmt->bind_param("s",$oui);
    
    
    $stmt->execute();
   
    
    echo "Handwerker added";
    
    
    
    
    
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


if(isset($_POST["sup"] ))
{
   
    $handwerker_name=$_POST["handwerker"];
    $handwerker_kategorie=$_POST["kategorie"];
    
    $handwerker_kommentar=$_POST["kommentar"];
    $handwerker_beschreibung=$_POST["beschreibung"];
   // $handwerker_haus=$_POST["haus"];
    $handwerker_verwaltungseinheit=$_POST["verwaltungseinheit"];
    $hausstrasse=$_POST["strasse"];
    $hausnr=$_POST["hausnr"];
    $hausplz=$_POST["plz"];
    $hausort=$_POST["ort"];
    
    
    if (empty($handwerker_name) || empty( $handwerker_kategorie) || empty( $handwerker_kommentar) || empty( $handwerker_beschreibung) ||  empty(  $handwerker_verwaltungseinheit) ||  empty( $hausstrasse) ||  empty(  $hausnr) ||  empty(  $hausplz) ||  empty(  $hausort)){
        echo "Bitte fuellen sie alle  Felder";
        
    }else {
    $query=mysqli_query($conn," select * from handwerker where Name='$handwerker_name'");
    
    while ($row=mysqli_fetch_array($query ) )
    {
        $H= $row["HandwerkerID"]    ;
        
    }
    
    $query1=mysqli_query($conn," select * from handwerker_kategorie where Name='$handwerker_kategorie'");
    
    
    while ($row=mysqli_fetch_array($query1 ) )
    {
        $K= $row["KategorieID"]    ;
        
        
    }
    
  /*  $query2=mysqli_query($conn," select * from hausobjekt where ObjektID='$handwerker_haus'");
    

    while ($row=mysqli_fetch_array($query2 ) )
    {
        $O= $row["ObjektID"]    ;
        
        
    }*/
        
        
        
         $query4=mysqli_query($conn," select ObjektID from hausobjekt where Strasse='$hausstrasse' and Hausnr='$hausnr' and PLZ='$hausplz' and Ort='$hausort'");
    
    
    while ($row=mysqli_fetch_array($query4 ) )
    {
        $OI= $row["ObjektID"]    ;
        
        
    }
    
    $query3=mysqli_query($conn," select VerwID from verwaltungseinheit where ObjektID='$OI' and Kommentar='$handwerker_verwaltungseinheit'");
    
    
    while ($row=mysqli_fetch_array($query3 ) )
    {
        $E= $row["VerwID"]    ;
        
        
    }
    
   
    
  
    
    
  //  $sql = "insert into handwerkerverwaltung (HandwerkerID,KategorieID ,ObjektID,VerwID,Aufgabebeschreibung,Kommentar)
  // values($H,$K,$O,$E,$handwerker_beschreibung, $handwerker_kommentar)";
    
    
   
    //mysqli_query($conn, $sql)m;
    
    
    
    $sql= "INSERT INTO handwerkerverwaltung (HandwerkerID, KategorieID, ObjektID, VerwID, Aufgabenbeschreibung, Kommentar) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "iiiiss", $H,$K,$OI,$E,$handwerker_beschreibung, $handwerker_kommentar);
    mysqli_stmt_execute($stmt);
   
   
    echo "done";
   
    
   
    }
    }
   
    //header("Location:..//handwerkerverwaltung.php");
    
    // $sql="DELETE FROM kategorie WHERE kategorie.Name = '$del';";
    //  mysqli_query($conn, $sql);
    
    
    
