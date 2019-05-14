<html>
	<head>
	<meta charset="utf-8">
	<meta name=viewport content="width-device-width, initial-scale=1">
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	
		<header>
			<nav>
				<ul>
					<li><a href="#">ImmoVerwaltung</a></li>
					<li><a href="#">Übersicht</a></li>
					<li><a href="#">Mein Konto</a></li>
					<li><a href="#">Einstellungen</a></li>
				</ul>
				<div>
					<form action="includes/login.inc.php" method="post">
						<input type="text" name="userid" placeholder="ID...">
						<input type="password" name="pwd" placeholder="Passwort...">
						<button type="submit" name="login-submit">Login</button>
					</form>
					<a href="signup.php">Signup</a>
					<form action="includes/logout.inc.php" method="post">
						<button type="submit" name="logout-submit">Logout</button>
					</form>
				</div>
			</nav>
		</header>



