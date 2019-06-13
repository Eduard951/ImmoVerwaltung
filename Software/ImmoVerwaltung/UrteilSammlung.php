<?php

require "header.php";
require "includes/dbh.inc.php";


?>
<?php 
if(isset($_SESSION['sessionid'])){
   
    
   
  echo'  <!DOCTYPE html>
    <html>
    <head>
    <title>Bootstrap Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    
    <div class="container">
    <h2>UrteilSammlung</h2>
  <div id="accordion">
    <div class="card">
    <div class="card-header">
    <a class="card-link" data-toggle="collapse" href="#collapseOne">
   Neue Urteil Hinzufuegen
    </a>
    </div>
    <div id="collapseOne" class="collapse show" data-parent="#accordion">
    <div class="card-body">
   
   <form action="includes/UrteilSammlung.inc.php" method="POST">
<label for="oui"><em>Stichtpunkt:</em></label> <input type="text" name="oui">

<br>
<label for="beschreibung"><em>UrteilBeschreibung:</em></label><textarea class="form-control" rows="4" type="text" id="beschreibung" name="beschreibung"></textarea>
<br>
<button type="submit" name="submit"> add</button>


</form>
    </div>
    </div>
    </div>
    <div class="card">
    <div class="card-header">
    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
   Nach Urteil Suchen
    </a>
    </div>
    <div id="collapseTwo" class="collapse" data-parent="#accordion">
    <div class="card-body">
   
   
   <form action="includes/UrteilSammlung.inc.php" method="POST">
<input type="text" name="non">
<button type="submit" name="submitt"> suchen</button>



</form>

    </div>
    </div>
    </div>
    
    </div>
   <a href="baumstruktur.php"><button class="btn btn-primary btn-lg">Zurueck</button> 
    </body>
    </html>';
    
    
}
?>