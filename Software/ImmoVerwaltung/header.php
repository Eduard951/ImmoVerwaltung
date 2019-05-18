<?php 
    session_start();
?>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark nav-fill">
			  <a class="navbar-brand" href="baumstruktur.php">ImmoVerwaltung</a>
 			   <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item"><a href="#" class="nav-link">Übersicht</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Mein Konto</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Einstellungen</a></li>
					<?php 
					if(isset($_SESSION['sessionname'])){
					    echo '
                            <li class="nav-item"><a class="btn btn-primary" href="postfach.php" role="button">Postfach</a>
                                <span class="badge"></span>
                            </button></li>
					<li class="nav-item">
						<form class="form-inline" action="includes/logout.inc.php" method="post">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout-submit">Logout</button>
						</form>
					</li>';
					}else {
					    echo'					<li>
						<form class="form-inline" action="includes/login.inc.php" method="post">
						<input class="form-control mr-sm-2" type="text" name="userid" placeholder="ID...">
						<input class="form-control mr-sm-2" type="password" name="pwd" placeholder="Passwort...">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="login-submit">Login</button>
						</form>
					</li>
					<li class="nav-item"><a class="nav-link" href="signup.php">Registrieren</a></li>';
					}
					?>
				</ul>
				</div>
			</nav>
		</header>
</body>
</html>


