<?php
    require "header.php";
?>


	<main>
		<h1>Signup</h1>
		<form action="includes/signup.inc.php" method="post">
		<input type="text" name="id" placeholder="BenutzerID...">
		<input type="text" name="mail" placeholder="E-Mail...">
		<input type="password" name="pwd" placeholder="Passwort...">
		<input type="password" name="pwd-repeat" placeholder="Repeat passwort...">
		<button type="submit" name="signup-submit">Signup</button>
		</form>
	</main>
	
<?php 
    require "footer.php";
?>
