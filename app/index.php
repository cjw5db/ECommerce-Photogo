<?php
	session_start();
 ?>



<!DOCTYPE HTML>
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
					<?php if(empty($_SESSION['logged_in'])) : ?>
					<a class="nav-item nav-link" href="login.php" style="border:none">Login</a>
					<a class="nav-item nav-link" href="signup.php" style="border:none">Sign Up</a>
					<?php endif;?>
				</div>
			</nav>
		</header>

		<div class="jumbotron text-center">
			<h1>Welcome to PhotoGo!</h1>
			<p>Buy photographs and contract photographers, all on one site!</p>
		</div>

		<div class="container">
			<div class="card-columns">
				<div class="card">
					<img class="card-img-top" src="images/fulls/1.jpg">
					<div class="card-body">
						<h5 class="card-title">Young Prospect</h5>
	      		<p class="card-text">Jonathan loves working with families and photographing sports</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Jonathan Quinkel</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=1" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/2.jpg">
					<div class="card-body">
						<h5 class="card-title">Wedding Photo</h5>
	      		<p class="card-text">Christina loves taking wedding photos in the fall</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Christina Melcan</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=2" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/3.jpg">
					<div class="card-body">
						<h5 class="card-title">Statue of Liberty</h5>
	      		<p class="card-text">Harry has a passion for architecture and loves the New York SKyline</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Harry Smoler</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=3" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/4.jpg">
					<div class="card-body">
						<h5 class="card-title">Jungle Action Shot</h5>
	      		<p class="card-text">Gina explores wild areas to catch pictures of the wildlife</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Gina Fastion</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=4" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/5.jpg">
					<div class="card-body">
						<h5 class="card-title">Pyramid of Giza</h5>
	      		<p class="card-text">Gage tries to take pictures of different cultures</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Gage Beckwhite</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=5" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/6.jpg">
					<div class="card-body">
						<h5 class="card-title">Winning Shot</h5>
	      		<p class="card-text">James exclusively photographs professional athletes</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">James Parker</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=6" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/7.jpg">
					<div class="card-body">
						<h5 class="card-title">Red Hot Chili Peppers Live at Cardinal Hall</h5>
	      		<p class="card-text">Megan spends her time taking photos of different bands in the Atlanta area</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Megan Titade</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=7" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/8.jpg">
					<div class="card-body">
						<h5 class="card-title">Bethany Beach Waves</h5>
	      		<p class="card-text">Ever since he was young, Tyler loved the ocean</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Tyler Santok</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=8" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/9.jpg">
					<div class="card-body">
						<h5 class="card-title">Peaceful Plains</h5>
	      		<p class="card-text">Nick lives in the Mid West and loves the rolling hills</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Nick Kenny</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=9" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/10.jpg">
					<div class="card-body">
						<h5 class="card-title">Alaskan Mountains</h5>
	      		<p class="card-text">Sheena's favorite season is winter</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Sheena Right</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=10" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/11.jpg">
					<div class="card-body">
						<h5 class="card-title">Cave of Wonder</h5>
	      		<p class="card-text">Lydia's inspiration was the cave from Disney's Alladin</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Lydia Petrolia</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=11" class="btn btn-primary text-center">View</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img-top" src="images/fulls/12.jpg">
					<div class="card-body">
						<h5 class="card-title">Tornado Town</h5>
	      		<p class="card-text">Thomas is always trying to capture natures craziest storms</p>
	      		<footer class="blockquote-footer text-right">
							<small class="text-muted">Thomas Grinta</small>
						</footer>
					</div>
					<div class="card-footer text-center">
						<a href="detail.php?id=12" class="btn btn-primary text-center">View</a>
					</div>
				</div>
			</div>
		</div>

		<footer>
			<nav class="navbar navbar-light bg-light">
				<a class="nav-item nav-link" href="index.php"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
			</nav>
		</footer>
	</body>
</html>
