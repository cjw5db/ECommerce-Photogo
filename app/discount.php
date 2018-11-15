<?php

  //make sure user logged in
  //if not, revert back to previous page:
  // header('Location: '.$_SERVER['HTTP_REFERER']);
  // exit();

  //get $db variable from get_db_connection.php

  //get discount code provided from form (will be available via $_POST)
  //will look like the following:
  // if ($_SERVER["REQUEST_METHOD"] == "POST"){
	// 	$code = htmlspecialchars($_POST['code']);

  //do a SELECT query on $db to get and store all values from discounts table associated with $code
  //if nothing returned (pg_num_rows == 0), then stop here and revert back to previous page

  //do a UPDATE query on $db to add the user's email ($_SESSION['email']) to the text array of usersclaimed for the row of discounts associated with $code

  //all done, return back to previous page

 ?>
