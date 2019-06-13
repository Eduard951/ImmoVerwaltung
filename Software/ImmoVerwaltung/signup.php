<?php
    require "header.php";
    //include ('server.php');
?>

	<main>
	<div class=container>
	<div class=row>	<div class="col-md-offset-8 col-md-4 "><h2>Registrierung<span class="badge badge-secondary"></span></h2></div></div>
		<form action="includes/signup.inc.php" method="post" class="col-md-offset-4 col-md-8">
			
			<input class="form-control " type="text" name="name" placeholder="Name.."> 
			<br>
			<input class="form-control  " type="text" name="nachname" placeholder="Nachname..">
			<br>
			<input class="form-control " type="text" name="mail" placeholder="E-Mail...">
			<br>
			<input class="form-control" type="password" name="pwd" placeholder="Passwort...">
			<br>
			<input class="form-control" type="password" name="pwd_repeat" placeholder="Wiederhole passwort...">
			<br>
			<input class="form-control" type="text" name="strasse" placeholder="Strasse..">
			<br>
			<input class="form-control" type="text" name="hausnr" placeholder="Hausnummer..">
			<br>
			<input class="form-control" type="text" name="plz" placeholder="PLZ..">
			<br>
			<input class="form-control" type="text" name="ort" placeholder="Ort..">
			<br>
			<button class="btn btn-secondary btn-lg form-control" type="submit" name="signup_submit">Registrieren</button>
		</form>
		</div>
	</main>
	
<?php 
    require "footer.php";
?>
