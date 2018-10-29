<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		include('get_db_connection.php');
		$result = pg_query_params($db, "SELECT email FROM users WHERE email = $1", array($_POST['usersEmail']));
		echo $result;
	}
 ?>

<html>
	<head>
		<title>PhotoGo</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light">
				<a class="nav-item nav-link" href="index.php"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
				<div class="navbar-nav">
					<a class="nav-item nav-link" href="about.php" style="border:none">About Us</a>
					<a class="nav-item nav-link" href="contact.php" style="border:none">Contact Us</a>
					<a class="nav-item nav-link" href="login.php" style="border:none">Login</a>
					<a class="nav-item nav-link" href="signup.php" style="border:none">Sign Up</a>
				</div>
			</nav>
		</header>

		<div class="jumbotron text-center">
			<h1>Login</h1>
		</div>

		<div class="container">
			<div class="text-center">
				<form action='<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>' method="post" role="form">
					<div class="form-row justify-content-center">
						<div class="form-group col-md-3">
		    			<input type="email" class="form-control" id="usersEmail" placeholder="Email">
						</div>
					</div>
					<div class="form-row justify-content-center">
						<div class="form-group col-md-3">
		    			<input type="password" class="form-control" id="usersPwd" placeholder="Password">
						</div>
					</div>
					<div class="form-row justify-content-center">
						<button type="submit" class="btn btn-primary btn-lg">Log In</button>
					</div>
				</form>
	    </div>
		</div>

		<footer>
			<nav class="navbar navbar-light bg-light fixed-bottom">
				<a class="nav-item nav-link" href="index.php"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
			</nav>
		</footer>
  </body>
</html>