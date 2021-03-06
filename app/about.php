<?php
	session_start();
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
					<?php if(isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == TRUE) : ?>
            <a class="nav-item nav-link" href="user.php" style="border:none">My Account</a>
						<a class="btn btn-primary" href="log_out.php">Log Out</a>
          <?php else :?>
            <a class="nav-item nav-link" href="login.php" style="border:none">Login</a>
  					<a class="nav-item nav-link" href="signup.php" style="border:none">Sign Up</a>
					<?php endif;?>
				</div>
			</nav>
		</header>

		<div class="jumbotron text-center">
			<h1>About Us</h1>
		</div>

		<div class="container">

			<h3>Product/Services</h3>
			<p> Photogo is a marketplace for photographers.  Photographers are able to post and sell their photos online, where general users are able to view, purchase, and download various sizes of the image directly from the site. In addition, if a buyer finds that they like a particular photographers skills, then they can reach out to the photographer to hire their services.</p> </br>
			<p> PhotoGo makes it easy to advertise and sell for photographers and also gives new artists a platform to post their photos and gain some recognition in the photography business.  The site is meant to be focused on the photographers and their work. </p>

			<h3>Why PhotoGo? </h3>
			<p> Currently there is a lack of marketability for photographer’s skills and their products.  There is no current way for them to sell ALL that they have to offer, which includes both their portfolio of personally taken photos and their contractible services.  There of course exist websites to buy photos as well as websites to hire contractible workers, but none that do both. </p> </br>
			<p> We here at PhotoGo give users an incredible place to both share images and support some of the most starved artists in our communities.  It is the combined ability of these two different services as well as the focus specifically on photography that makes PhotoGo Unique. If you have any questions please visit the Contact Us Page! </p>
			<?php if(empty($_SESSION['logged_in']) or $_SESSION['logged_in'] == FALSE) : ?>
			<div class="row justify-content-center">
				<a class="btn btn-primary btn-lg" href="signup.php" role="button">Sign Up Now!</a>
			</div>
			<?php endif ;?>
		</div>

		<footer>
			<nav class="navbar navbar-light bg-light">
				<a class="nav-item nav-link" href="index.php"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
			</nav>
		</footer>
  </body>
</html>
