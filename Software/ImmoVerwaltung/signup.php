<?php
    require "header.php";
?>


	<main>
		<h2>Registrierung<span class="badge badge-secondary"></span></h2>
		<form action="includes/signup.inc.php" method="post">
		<input class="form-control" type="text" name="id" placeholder="BenutzerID...">
		<br>
		<input class="form-control" type="text" name="mail" placeholder="E-Mail...">
		<br>
		<input class="form-control" type="password" name="pwd" placeholder="Passwort...">
		<br>
		<input class="form-control" type="password" name="pwd-repeat" placeholder="Repeat passwort...">
		<br>
		<button class="btn btn-secondary btn-lg" type="submit" name="signup-submit">Registrieren</button>
		</form>
	</main>
	
<?php 
    require "footer.php";
?>
