<?php
  session_start();
  $picPath = "images/fulls/".$_GET['id'].".jpg";
  include('get_db_connection.php');
  $result = pg_query_params($db, "SELECT * FROM product WHERE id = $1", array($_GET['id']));
  if (pg_num_rows($result) != 0){
    $price = pg_fetch_result($result, 0, 'price');
  }
  include('get_bitpay_token.php');
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
          <?php if(empty($_SESSION['logged_in'])) : ?>
  		      <a class="nav-item nav-link" href="login.php" style="border:none">Login</a>
  					<a class="nav-item nav-link" href="signup.php" style="border:none">Sign Up</a>
          <?php else :?>
						<a class="btn btn-primary" href="log_out.php">Log Out</a>
					<?php endif;?>
		    </div>
			</nav>
		</header>

    <body>
      <div class="container">
        <div class="media">
          <img src=<?php echo $picPath ?> class="rounded mr-3" style="width:640px;height:480px;">
          <div class="media-body">

            <div class="card">
    					<div class="card-body">
    						<h5 class="card-title"><?php echo pg_fetch_result($result, 0, 'title')?></h5>
    	      		<p class="card-text"><?php echo pg_fetch_result($result, 0, 'description')?></p>
    	      		<footer class="blockquote-footer text-right">
    							<small class="text-muted"><?php echo pg_fetch_result($result, 0, 'photographer')?></small>
    						</footer>
    					</div>
    					<div class="card-footer text-center">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#purchaseModal">
                  Purchase - <i class="fab fa-bitcoin"></i><?php echo pg_fetch_result($result, 0, 'price')?>
                </button>
    					</div>
    				</div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="Purchase" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">Purchase</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              By clicking purchase, you will receive a bitcoin invoice via your account email.  It will expire in 15 minutes.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a role="button" class="btn btn-primary" href=<?php echo "transaction.php?price=".pg_fetch_result($result, 0, 'price')?>">Purchase</a>
            </div>
          </div>
        </div>
      </div>

      <div class="container">

      </div>
    </body>

    <footer>
  		<nav class="navbar navbar-light bg-light fixed-bottom">
    		<a class="nav-item nav-link" href="index.php"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
  		</nav>
  	</footer>
  </html>
