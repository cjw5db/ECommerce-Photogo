<?php
  session_start();
  // if not logged in, then send back to previous page
  if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == FALSE or !isset($_SESSION['email'])){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }

  // if not all data sent in get request, then send back to previous page
  if(empty($_GET["id"])){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }

  $id = htmlspecialchars($_GET['id']);

  //get database connection, sets variable $db
  include('get_db_connection.php');

  //do the query on the database to add a favorite
  $result = pg_query_params($db, "UPDATE users SET favorites = array_append(favorites, $1) WHERE email = $2", array($id, $_SESSION['email']));

  //send user back to previous page
  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit();

 ?>
