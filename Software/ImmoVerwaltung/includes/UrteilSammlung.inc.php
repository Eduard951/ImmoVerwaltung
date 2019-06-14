<?php 
require ('dbh.inc.php');
?>

<?php
if(isset($_POST["submit"]))

{
    $name=$_POST["oui"];
    $text=$_POST["beschreibung"];
    
    $sql= "INSERT INTO urteilsammlung (Stichwort,Text) VALUES (?,?)";
    $stmt = mysqli_stmt_init($conn);
    
    if (empty($name) || empty($text)){
        echo "Bitte fuellen sie alle  Felder";
        
    }else {
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sql_error");
            exit();
        }
        else {
              mysqli_stmt_bind_param($stmt, "ss", $name, $text);
              mysqli_stmt_execute($stmt);
              echo 'Urteil  added';
             
        }
        
    }
}


if(isset($_POST["submitt"]))

{
    echo '<div class="container">';
    $p=$_POST["non"];
   
    $query=mysqli_query($conn," select * from urteilsammlung where stichwort='$p'");
    
  //  $sql=" select * from urteilsammlung where Name=' $p' ";
  
   
    while ($row=mysqli_fetch_array($query ) )
    {
     
        $a= $row["Text"]    ;
       
        
    }
   
    echo '<div class="row">';
    echo' <table class="table table-bordered table-striped table-condensed col-md-offset-2 col-md-8">';
    
    echo '<tbody>';
    echo '<tr>';
    echo "<td>"."$p" ."</td>". "<td>"."$a"." </td>";
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    
    echo '</div>';
}


?>

