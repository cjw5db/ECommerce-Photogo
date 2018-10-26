<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nameErr = $emailErr = $addressErr = $cityErr =
    $stateErr = $zipErr = $pwdErr = $pwdConfirmErr = NULL;

    $anyErr = FALSE;

    $fields = array(
      'name' => '',
      'email' => '',
      'address' => '',
      'city' => '',
      'state' => '',
      'zip code' => '',
      'passwordHash' => '');

    if(empty($_POST["usersName"])){
      $nameErr = "Name must have a value";
      $anyErr = TRUE;
    }
    else if(preg_match("/[^a-zA-Z\s]/", htmlspecialchars($_POST["usersName"])) == 1){
      $nameErr = "Name must only contain letters";
      $anyErr = TRUE;
    }
    else{
      $fields["name"] = htmlspecialchars($_POST["usersName"]);
    }



    if(empty($_POST["usersEmail"])){
      $emailErr = "Email must have a value";
      $anyErr = TRUE;
    }
    else if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,}$/", htmlspecialchars($_POST["usersEmail"])) == 0){
      $emailErr = "Email must be of the correct format";
      $anyErr = TRUE;
    }
    else{
      $fields["email"] = htmlspecialchars($_POST["usersEmail"]);
    }



    if(empty($_POST["usersAddress"])){
      $addressErr = "Address must have a value";
      $anyErr = TRUE;
    }
    else if(preg_match("/[^a-zA-Z0-9\s]/", htmlspecialchars($_POST["usersAddress"])) == 1){
      $addressErr = "Address must only contain letters and numbers";
      $anyErr = TRUE;
    }
    else{
      $fields["address"] = htmlspecialchars($_POST["usersAddress"]);
    }



    if(empty($_POST["usersCity"])){
      $cityErr = "City must have a value";
      $anyErr = TRUE;
    }
    else if(preg_match("/[^a-zA-Z\s]/", htmlspecialchars($_POST["usersCity"])) == 1){
      $cityErr = "City must only contain letters";
      $anyErr = TRUE;
    }
    else{
      $fields["city"] = htmlspecialchars($_POST["usersCity"]);
    }



    if(empty($_POST["usersState"])){
      $stateErr = "State must have a value";
      $anyErr = TRUE;
    }
    else if(preg_match("/[^a-zA-Z\s]/", htmlspecialchars($_POST["usersState"])) == 1){
      $stateErr = "State must only contain letters";
      $anyErr = TRUE;
    }
    else{
      $fields["state"] = htmlspecialchars($_POST["usersState"]);
    }



    if(empty($_POST["usersZip"])){
      $zipErr = "Zip must have a value";
      $anyErr = TRUE;
    }
    else if(preg_match("/[^0-9]/", htmlspecialchars($_POST["usersZip"])) == 1){
      $zipErr = "Zip must only be numbers";
      $anyErr = TRUE;
    }
    else if (strlen(htmlspecialchars($_POST["usersZip"])) !== 5){
      $zipErr = "Zip must be exactly five numbers";
      $anyErr = TRUE;
    }
    else{
      $fields["zip code"] = htmlspecialchars($_POST["usersZip"]);
    }



    if(empty($_POST["usersPwd"])){
      $pwdErr = "Password must have a value";
      $anyErr = TRUE;
    }
    else if(empty($_POST["usersPwdConfirm"])){
      $pwdConfirmErr = "Password must have a value";
      $anyErr = TRUE;
    }
    else if(strcmp(htmlspecialchars($_POST["usersPwdConfirm"]), htmlspecialchars($_POST["usersPwd"])) !== 0){
      $pwdErr = "Passwords must match";
      $pwdConfirmErr = "Passwords must match";
      $anyErr = TRUE;
    }
    else{
      $raw_password = htmlspecialchars($_POST["usersPwd"]);
      $fields["passwordHash"] = password_hash($raw_password, PASSWORD_DEFAULT);

    }

    if ($anyErr == FALSE){
      include('get_db_connection.php');

      $result = pg_query_params($db, "SELECT email FROM users WHERE email = $1", array($fields['email']));

      if (pg_num_rows($result) != 0){
        $emailErr = "Email already taken - please enter a different one";
      }
      else{
        pg_insert($db, "users", $fields);
      }
    }
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
  			<a class="nav-item nav-link" href="index.html"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
  	    <div class="navbar-nav">
  	      <a class="nav-item nav-link" href="about.html" style="border:none">About Us</a>
  	      <a class="nav-item nav-link" href="contact.html" style="border:none">Contact Us</a>
  	      <a class="nav-item nav-link" href="login.html" style="border:none">Login</a>
  				<a class="nav-item nav-link" href="signup.php" style="border:none">Sign Up</a>
  	    </div>
  		</nav>
		</header>


    <div class="jumbotron text-center">
      <h1>Sign Up</h1>
    </div>

    <div class="container">

			<form style="padding-left:50px; padding-right:50px" action='<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post' role="form">

				<div class="form-group">
					<label for="usersName">Name</label>
          <?php if(isset($nameErr)) : ?>
      			<input type="text" name="usersName" class="col-sm-3 form-control is-invalid" id="usersName" placeholder="name">
            <div class="invalid-feedback">
              <?php echo $nameErr ;?>
            </div>
          <?php else: ?>
            <input type="text" name="usersName" class="col-sm-3 form-control is-valid" id="usersName" placeholder="name">
          <?php endif; ?>
				</div>

				<div class="form-group">
					<label for="usersEmail">Email</label>
          <?php if(isset($emailErr)) : ?>
    			  <input type="email" name="usersEmail" class="col-sm-3 form-control is-invalid" id="usersEmail" placeholder="email">
            <div class="invalid-feedback">
              <?php echo $emailErr ;?>
            </div>
          <?php else : ?>
            <input type="email" name="usersEmail" class="col-sm-3 form-control is-valid" id="usersEmail" placeholder="email">
          <?php endif ; ?>
				</div>

				<div class="form-group">
					<label for="usersAddress">Address</label>
          <?php if(isset($addressErr)) : ?>
    			  <input type="text" name="usersAddress" class="col-sm-3 form-control is-invalid" id="usersAddress" placeholder="address">
            <div class="invalid-feedback">
              <?php echo $addressErr ;?>
            </div>
          <?php else : ?>
            <input type="text" name="usersAddress" class="col-sm-3 form-control is-valid" id="usersAddress" placeholder="address">
          <?php endif ; ?>
				</div>

				<div class="form-group">
					<label for="usersCity">City</label>
          <?php if(isset($cityErr)) : ?>
    			  <input type="text" name="usersCity" class="col-sm-2 form-control is-invalid" id="usersCity" placeholder="city">
            <div class="invalid-feedback">
              <?php echo $cityErr;?>
            </div>
          <?php else : ?>
            <input type="text" name="usersCity" class="col-sm-2 form-control is-valid" id="usersCity" placeholder="city">
          <?php endif ;?>
        </div>

				<div class="form-group">
					<label for="usersState">State</label>
          <?php if(isset($stateErr)) : ?>
					  <select name="usersState" class="col-sm-1 form-control is-invalid" id="usersState">
          <?php else : ?>
            <select name="usersState" class="col-sm-1 form-control is-valid" id="usersState">
          <?php endif;?>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
          <?php if(isset($stateErr)) : ?>
            <div class="invalid-feedback">
              <?php echo $stateErr ;?>
            </div>
          <?php endif;?>
				</div>

				<div class="form-group">
					<label for="usersZip">Zip Code</label>
          <?php if(isset($zipErr)) : ?>
    			  <input type="text" name="usersZip" class="col-sm-1 form-control is-invalid" id="usersZip" placeholder="zip code">
            <div class="invalid-feedback">
              <?php echo $zipErr ;?>
            </div>
          <?php else : ?>
            <input type="text" name="usersZip" class="col-sm-1 form-control is-valid" id="usersZip" placeholder="zip code">
          <?php endif;?>
				</div>

				<div class="form-group">
					<label for="usersPwd">Password</label>
          <?php if(isset($pwdErr)) :?>
    			  <input type="password" name="usersPwd" class="col-sm-3 form-control is-invalid" id="usersPwd" placeholder="password">
            <div class="invalid-feedback">
              <?php echo $pwdErr ;?>
            </div>
          <?php else : ?>
            <input type="password" name="usersPwd" class="col-sm-3 form-control is-valid" id="usersPwd" placeholder="password">
          <?php endif ;?>
        </div>

				<div class="form-group">
					<label for="usersPwdConfirm">Confirm Password</label>
          <?php if(isset($pwdConfirmErr)) :?>
    			  <input type="password" name="usersPwdConfirm" class="col-sm-3 form-control is-invalid" id="usersPwdConfirm" placeholder="password">
            <div class="invalid-feedback">
              <?php echo $pwdConfirmErr ;?>
            </div>
          <?php else : ?>
             <input type="password" name="usersPwdConfirm" class="col-sm-3 form-control is-valid" id="usersPwdConfirm" placeholder="password">
          <?php endif ;?>
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>

			</form>
		</div>

    <nav class="navbar navbar-light bg-light">
  		<a class="nav-item nav-link" href="index.html"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
		</nav>

  </body>
</html>
