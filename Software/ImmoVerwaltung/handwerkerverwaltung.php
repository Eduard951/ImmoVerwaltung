<?php
require "header.php";

?>
    
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
if(isset($_SESSION['sessionid'])){
    
    $query=mysqli_query($conn, "select * from handwerker_kategorie");
    $query1=mysqli_query($conn, "select * from handwerker");
    $query2=mysqli_query($conn, "select * from  handwerker_kategorie");
    $query3=mysqli_query($conn, "select * from hausobjekt");
    $query4=mysqli_query($conn, "select * from verwaltungseinheit");
    $query5=mysqli_query($conn, "select * from hausobjekt ORDER BY Strasse ASC");
    $query6=mysqli_query($conn, "select * from hausobjekt ORDER BY Hausnr ASC");
    $query7=mysqli_query($conn, "select * from hausobjekt ORDER BY PLZ ASC");
    $query8=mysqli_query($conn, "select * from hausobjekt ORDER BY Ort ASC");
echo '
<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>HandwerkerVerwaltung</h2>
  
  <div id="accordion">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapseOne">
         Handwerker Fuer eine Neue Kategorie Hinzufuegen
        </a>
      </div>
      <div id="collapseOne" class="collapse show" data-parent="#accordion">
        <div class="card-body">
          
<form action="includes/handwerkerverwaltung.inc.php" method="POST">';
echo ' <select name="handwerker">
       <option> Handwerker</option>   ';
while ($row=mysqli_fetch_array($query1 )  )
{
    echo '<option value="'.$row["Name"].'">'   .$row["Name"]     .'</option>';
    
    
}
    echo '</select>';
    
    echo ' <select name="kategorie">
       <option> Kategorie</option>   ';
    while ($row=mysqli_fetch_array($query2 ) )
    {
        echo '<option value="'.$row["Name"].'">'   .$row["Name"]     .'</option>';
        
        
    }
    echo '</select>';
    
    
   /* echo ' <select name="haus">
       <option> Haus</option>   ';
    while ($row=mysqli_fetch_array($query3 ) )
    {
        echo '<option value="'.$row["ObjektID"].'">'   .$row["ObjektID"]     .'</option>';
        
        
    }
    echo '</select>';*/
  
    echo ' <select name="strasse">
       <option> Strasse</option>   ';
    while ($row=mysqli_fetch_array($query5 ) )
    {
        echo '<option value="'.$row["Strasse"].'">'   .$row["Strasse"]     .'</option>';
        
       
    }
    echo '</select>';
    echo ' <select name="hausnr">
       <option> Hausnr</option>   ';
    while ($row=mysqli_fetch_array($query6 ) )
    {
        echo '<option value="'.$row["Hausnr"].'">'   .$row["Hausnr"]     .'</option>';
        
        
    }
    echo '</select>';
    
    echo ' <select name="plz">
       <option> PLZ</option>   ';
    while ($row=mysqli_fetch_array($query7 ) )
    {
        echo '<option value="'.$row["PLZ"].'">'   .$row["PLZ"]     .'</option>';
        
        
    }
    echo '</select>';
    echo ' <select name="ort">
       <option> Ort</option>   ';
    while ($row=mysqli_fetch_array($query8 ) )
    {
        echo '<option value="'.$row["Ort"].'">'   .$row["Ort"]     .'</option>';
        
        
    }
    echo '</select>';
    
    
    
    echo ' <select name="verwaltungseinheit">
       <option> Verwaltungseinheit</option>   ';
    while ($row=mysqli_fetch_array($query4 ) )
    {
        echo '<option value="'.$row["Kommentar"].'">'   .$row["Kommentar"]     .'</option>';
        
        
    }
    echo '</select>';
    
    
    echo '</br>';
    echo '<label for="beschreibung">Beschreibung:</label><textarea class="form-control" rows="2" type="text" id="beschreibung" name="beschreibung">Beschreibung</textarea>';
    echo '<label for="kommentar">kommentar:</label><textarea class="form-control" rows="2" type="text" id="kommentar" name="kommentar">Kommentar</textarea>';
    echo '<button type="submit" name="sup"> Submit</button>';
echo '</form>';
  echo' </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
        Neu Kategorie Hinzufuegen
      </a>
      </div>
      <div id="collapseTwo" class="collapse" data-parent="#accordion">
        <div class="card-body">
        

   <form action="includes/handwerkerverwaltung.inc.php" method="POST">
<input type="text" name="oui">
<button type="submit" name="submit"> add</button>';



echo '</form>';
     




 echo'       </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
         Kategorie Loeschen
        </a>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
          
            <form action="includes/handwerkerverwaltung.inc.php" method="POST">
      
        <table border="1">
         <tr>
          <th></th>
         <th>Verfuegbare Kategorie</th>
         </tr>


                                                                 ';
          
           while ($row=mysqli_fetch_array($query))
{
echo '<tr>';
echo '<td><input type="checkbox" name="checkbox[]" value="'.$row['KategorieID'].'"></td><td>'.$row["Name"].'</td>';
echo '</tr>';
}
echo '</table>';
echo '<button type="submit" name="dela"> delate</button>';
  echo ' </form> ';   

  echo'     </div>
      </div>
    </div>
 


  <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
        Neu Handwerker Hinzufuegene
      </a>
      </div>
      <div id="collapseFour" class="collapse" data-parent="#accordion">
        <div class="card-body">
        

   <form action="includes/handwerkerverwaltung.inc.php" method="POST">
<input type="text" name="sus">
<button type="submit" name="suss"> add</button>';



echo '</form>';
     




 echo'  </div>
      </div>
    </div>



 </div>

</div>
    
</body>
</html>';
 
}

?>


 
 <?php 
    require "footer.php";
?>
 
 
