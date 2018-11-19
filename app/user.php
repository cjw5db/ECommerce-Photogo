<?php
  session_start();

  if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in']==FALSE){
		header('Location: index.php');
    exit();
	}

  if(isset($_SESSION['email'])){
    include('get_db_connection.php');
    $result = pg_query_params($db, "SELECT array_to_json(favorites) AS favorites FROM users WHERE email = $1", array($_SESSION['email']));
    if (pg_num_rows($result) != 0){
      $favorites = json_decode(pg_fetch_result($result, 0, 'favorites'));
    }
    $result = pg_query_params($db, "SELECT * FROM users WHERE email = $1", array($_SESSION['email']));
    $name = pg_fetch_result($result, 0, 'name');
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
      <h1>Welcome, <?php echo $name ?>!</h1>
      <p>
        <a href="update_email.php" class="btn btn-primary btn-lg my-3">Update Email</a>
        <a href="update_password.php" class="btn btn-primary btn-lg my-3">Update Password</a>
      </p>
    </div>

    <?php if(!empty($favorites)) : ?>
      <div class="jumbotron bg-light text-center">
        <h1><?php echo $name ?>'s Favorite Photos</h1>
      </div>
    <?php else :?>
      <div class="jumbotron bg-light text-center">
        <h1>No Photos Favorited Yet</h1>
        <p>Just click the heart button on any photo you want to favorite and it will be saved for you here!</p>
      </div>
    <?php endif ;?>

    <?php if(!empty($favorites)):?>
      <div class="container">
  			<div class="card-columns">
          <?php
            foreach ($favorites as $favorite) {
              $result = pg_query_params($db, "SELECT * FROM products WHERE id = $1", array($favorite));
              $picPath = "images/fulls/".$favorite.".jpg";
          ?>
    				<div class="card">
    					<img class="card-img-top" src=<?php echo $picPath ?>>
    					<div class="card-body">
    						<h5 class="card-title"><?php echo pg_fetch_result($result, 0, 'title')?></h5>
    	      		<p class="card-text"><?php echo pg_fetch_result($result, 0, 'description')?></p>
    	      		<footer class="blockquote-footer text-right">
    							<small class="text-muted"><?php echo pg_fetch_result($result, 0, 'photographer')?></small>
    						</footer>
    					</div>
    					<div class="card-footer text-center">
    						<a href=<?php echo "detail.php?id=".$favorite ?> class="btn btn-primary text-center">View</a>
                <a href=<?php echo "remove_favorite.php?id=".$favorite ?> class="btn btn-danger text-center"><i class="fas fa-heart"></i></a>
    					</div>
    				</div>
          <?php } ?>
        </div>
      </div>
    <?php endif ;?>

    <footer>
      <nav class="navbar navbar-light bg-light">
        <a class="nav-item nav-link" href="index.php"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
      </nav>
    </footer>
  </body>
</html>
