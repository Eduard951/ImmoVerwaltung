<?php
    require "header.php";
    //include ('server.php');
?>

	<main>
		<h2>Registrierung<span class="badge badge-secondary"></span></h2>
		<form action="includes/signup.inc.php" method="post">
			
			<input class="form-control" type="text" name="benutzername" placeholder="Benutzername..">
			<br>
			<input class="form-control" type="text" name="mail" placeholder="E-Mail...">
			<br>
			<input class="form-control" type="password" name="pwd" placeholder="Passwort...">
			<br>
			<input class="form-control" type="password" name="pwd_repeat" placeholder="Repeat passwort...">
			<br>
			<button class="btn btn-secondary btn-lg" type="submit" name="signup_submit">Registrieren</button>
		</form>
	</main>
	
<?php 
    require "footer.php";
?>
