<?php
  session_start();
  $picPath = "images/fulls/".$_GET['id'].".jpg";
  $discountapplied = FALSE;
  include('get_db_connection.php');
  $photoResult = pg_query_params($db, "SELECT * FROM products WHERE id = $1", array($_GET['id']));
  if (pg_num_rows($photoResult) != 0){
    $price = pg_fetch_result($photoResult, 0, 'price');
    $price = floatval($price);

    if(isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == TRUE){
      $photoid = htmlspecialchars($_GET['id']);
      $result = pg_query_params($db, "SELECT array_to_json(usersclaimed) AS usersclaimed FROM discounts WHERE photoid = $1", array($photoid));
      if(pg_num_rows($result) != 0){
        $usersclaimed = json_decode(pg_fetch_result($result, 0, 'usersclaimed'));
        $result = pg_query_params($db, "SELECT discountpercent FROM discounts WHERE photoid = $1", array($photoid));
        $discountpercent = pg_fetch_result($result, 0, 'discountpercent');
        if(in_array($_SESSION['email'], $usersclaimed)){
          $floatpercent = floatval($discountpercent);
          $price = $price * (1-$floatpercent);
          $discountapplied = TRUE;
        }
      }
    }
  }

  $json = file_get_contents('https://blockchain.info/ticker');
  $obj = json_decode($json);
  $dollarConv = $obj->USD->last;
  $dollarPrice = $dollarConv * $price;
  $dollarPrice = round($dollarPrice, 2);
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

    <body>
      <?php if($discountapplied) :?>
        <div class="alert alert-success text-center" role="alert">
          <?php echo ($discountpercent * 100)."%" ;?> Discount Applied!
        </div>
      <?php endif ;?>
      <div class="container">
        <div class="media">
          <img src=<?php echo $picPath ?> class="rounded mr-3" style="width:640px;height:480px;">
          <div class="media-body">

            <div class="card">
    					<div class="card-body">
    						<h5 class="card-title"><?php echo pg_fetch_result($photoResult, 0, 'title')?></h5>
    	      		<p class="card-text"><?php echo pg_fetch_result($photoResult, 0, 'description')?></p>
    	      		<footer class="blockquote-footer text-right">
    							<small class="text-muted"><?php echo pg_fetch_result($photoResult, 0, 'photographer')." (".pg_fetch_result($photoResult, 0, 'photographeremail').")"?></small>
    						</footer>
    					</div>
    					<div class="card-footer text-center">
                <div class="btn-group" role="group">
                  <button type="button" class="btn btn-success btn-lg">
                    <i class="fab fa-bitcoin"></i><?php echo $price?>
                  </button>
                  <?php if(isset($_SESSION['logged_in'])) : ?>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#purchaseModal">
                      Purchase
                    </button>
                  <?php else : ?>
                    <a class="btn btn-warning btn-lg" href="login.php">
                      Log in to purchase
                    </a>
                  <?php endif ;?>
                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#conversionModal">
                      Convert Price ($USD)
                  </button>

                  <?php if(isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == TRUE) :?>
                    <div class="btn-group" role="group">
                      <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Discount
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form class="px-4 py-3" action='discount.php' method="post" role="form">
                          <div class="form-group">
                            <label for="code">Discount Code</label>
                            <input type="text" class="form-control" id="code" name='code' placeholder="my-code">
                          </div>
                          <button type="submit" class="btn btn-primary">Apply Code</button>
                        </form>
                      </div>
                    </div>
                  <?php endif ;?>
                </div>
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
              <form action="https://test.bitpay.com/checkout" method="post">
                <input type="hidden" name="action" value="checkout" />
                <input type="hidden" name="posData" value="" />
                <input type="hidden" name="price" value="<?php echo $price;?>" />
                <input type="hidden" name="data" value="qzJcvD360bZEdUmbKOCpiyndSPPBJCTRcsSzFm/EvKXFke0xjaYFp7oo+7DfTZEhSKKO5kYAMM+z6g2Pbjo7mrlAYctVVjK8uuC/JwN3DG+a7iXCdynrXp/XBPuF5t4qRy5A5ZDXrA8PoIPM7i6gjLnulN5nmMY3K/N18Rc5Y75N5yFwTHKeZs+KaJLKNy/8VcUboOw7EARElCWJTuuZUg==" />
                <input type="image" src="https://test.bitpay.com/cdn/en_US/bp-btn-pay-currencies.svg" name="submit" style="width:168px;" alt="BitPay, the easy way to pay with bitcoins." >
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="conversionModal" tabindex="-1" role="dialog" aria-labelledby="Convert Price ($USD)" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">Convert Price ($USD)</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo "$", $dollarPrice ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
