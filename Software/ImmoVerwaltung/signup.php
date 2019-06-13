<?php
    require "header.php";
    //include ('server.php');
?>

	<main>
	<div class=container>
	<div class=row>	<div class="col-md-offset-6 col-md-4 "><h2>Registrierung<span class="badge badge-secondary"></span></h2></div></div>
	<br>
	<br>
		<form action="includes/signup.inc.php" method="post" class="row">
			 
			<input class="col-md-offset-1 col-md-5 form-control" type="text" name="name" placeholder="Name.."> 
			
			<input class="col-md-offset-1 col-md-5 form-control " type="text" name="nachname" placeholder="Nachname..">
			
			<input class="col-md-offset-1 col-md-5 form-control " type="text" name="mail" placeholder="E-Mail...">
			
			<input class="col-md-offset-1 col-md-5 form-control" type="password" name="pwd" placeholder="Passwort...">
			
			<input class="col-md-offset-1 col-md-5 form-control" type="password" name="pwd_repeat" placeholder="Wiederhole passwort...">
			 
			<input class="col-md-offset-1 col-md-5 form-control" type="text" name="strasse" placeholder="Strasse..">
		 	
			<input class="col-md-offset-1 col-md-5 form-control" type="text" name="hausnr" placeholder="Hausnummer..">
			
			<input class="col-md-offset-1 col-md-5 form-control" type="text" name="plz" placeholder="PLZ..">
			
			<input class="col-md-offset-1 col-md-5 form-control" type="text" name="ort" placeholder="Ort..">
			
			<button class="btn btn-secondary form-control col-md-8" type="submit" name="signup_submit">Registrieren</button>
		</form>
		</div>
	</main>
	
<?php 
    require "footer.php";
?>
