<?php

require "header.php";
require "includes/dbh.inc.php";


?>
<?php  
if(isset($_SESSION['sessionid'])){
   

    echo' <form action="includes/Datenschutzauskunft.inc.php" method="POST">
<h3> Meine Daten Ansehen</h3></br>
<button type="submit" class="btn btn-success" name="submi "> suchen</button>

     

</form> ';
    
}
?>