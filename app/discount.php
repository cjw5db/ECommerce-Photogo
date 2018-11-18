<?php
session_start();
  //make sure user logged in
  //if not, revert back to previous page:
  // header('Location: '.$_SERVER['HTTP_REFERER']);
  // exit();
  if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == FALSE or !isset($_SESSION['email'])){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }

  //get $db variable from get_db_connection.php
  include('get_db_connection.php');

  //get discount code provided from form (will be available via $_POST)
  //will look like the following:
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$code = htmlspecialchars($_POST['code']);
  }

  //do a SELECT query on $db to get and store all values from discounts table associated with $code
  //if nothing returned (pg_num_rows == 0), then stop here and revert back to previous page
  if (pg_num_rows == 0){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }
  else {
    $result = pg_query_params($db, "SELECT * FROM discounts WHERE id = $code");
  }

  //do a SELECT query on $db to get and store all values from users table associated with $_SESSION['email']
  //if nothing returned (pg_num_rows == 0), then stop here and revert back to previous page
  if (pg_num_rows == 0){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }
  else {
    $result = pg_query_params($db, "SELECT * FROM users WHERE email = $_SESSION['email']", array($_SESSION['email']));
  }

 //do a UPDATE query on $db to add the user's id number to the integer list of usersclaimed for the row of discounts associated with $code
  $result = pg_query_params($db, "UPDATE discounts SET usersclaimed = array_append(usersclaimed, $id) WHERE code = $code", array($id, $_SESSION['email']));

  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit();

 ?>
