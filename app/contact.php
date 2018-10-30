<?php
    
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nameErr = $emailErr = $messageErr = NULL;
        
        $anyErr = FALSE;
        
        $fields = array(
                        'name' => '',
                        'email' => '',
                        'message' => '');
        

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
        
        if(empty($_POST["usersMessage"])){
            $messageErr = "Please include a message with your contact info";
            $anyErr = TRUE;
        }
        else{
            $fields["message"] = htmlspecialchars($_POST["usersMessage"]);
        }

       // if(!anyErr){
        //email part
        //Load Composer's autoloader
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        $outlook = 'PhotoGoECommerce@outlook.com';
        $pwd = 'photogo2018!';
        $host = 'smtp-mail.outlook.com';
        
        $mail->IsSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = TRUE;
        $mail->Username = $outlook;
        $mail->Password = $pwd;
        $mail->Port=587;
        //Set who the message is to be sent from
        $mail->setFrom('PhotoGoECommerce@outlook.com', 'Photo Go');
        //Set an alternative reply-to address
        $mail->addReplyTo('PhotoGoECommerce@outlook.com', 'Photo Go');
        //Set who the message is to be sent to
        $mail->addAddress('PhotoGoECommerce@outlook.com');
        //Set the subject line
        $mail->Subject = 'Contact Us Page has been activated by a User';
        $mail->Body = $fields["message"]." ".$fields["name"]." ".$fields["email"];
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        //Replace the plain text body with one created manually
        $mail->AltBody = $fields["message"]." ".$fields["name"]." ".$fields["email"];
        
        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
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
			<h1>Contact Us</h1>
			<p>	Send us a quick message.  We will be happy to answer all your questions and set up a meeting if needed! </p>
		</div>

		<div class="container">
			<form action='<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>' method='post' role="form">
				<div class="form-row justify-content-center">
					<div class="form-group col-md-4">
						<input type="text" name="usersName" class="form-control form-control" id="usersName" placeholder="Name">
					</div>
				</div>

				<div class="form-row justify-content-center">
					<div class="form-group col-md-4">
						<input type="email" class="form-control form-control" id="usersEmail" placeholder="Email">
					</div>
				</div>

				<div class="form-row justify-content-center">
					<div class="form-group col-md-4">
						<textarea class="form-control form-control" id="usersMessage" placeholder="Message"></textarea>
					</div>
				</div>

				<div class="form-row justify-content-center">
					<button type="submit" class="btn btn-primary btn-lg">Contact</button>
				</div>
			</form>
		</div>

		<footer>
			<nav class="navbar navbar-light bg-light fixed-bottom">
				<a class="nav-item nav-link" href="index.php"><i class="fas fa-camera-retro fa-2x">PhotoGo</i></a>
			</nav>
		</footer>
  </body>
</html>
