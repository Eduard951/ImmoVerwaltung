<?php 
    session_start();
?>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	</head>
	<body>
	
	
			<nav class="navbar navbar-expand-md navbar-dark bg-dark ">
			  <a class="navbar-brand" href="baumstruktur.php">ImmoVerwaltung</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
             <span class="navbar-toggler-icon"></span>
             </button>
             
 			   <div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav ">
					<li class="nav-item"><a href="index.php" class="nav-link">Übersicht</a></li>
					<li class="nav-item"><a href="konto.php" class="nav-link">Mein Konto</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Einstellungen</a></li>
					<?php 
					if(isset($_SESSION['sessionid'])){
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
						<input class="form-control mr-sm-2" type="text" name="mail" placeholder="E-Mail...">
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
		
</body>
</html>

