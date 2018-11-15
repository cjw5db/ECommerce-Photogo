<?php
  session_start();
  if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == FALSE or !isset($_SESSION['email'])){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }

  if(empty($_GET["id"])){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }

  $id = htmlspecialchars($_GET['id']);

  include('get_db_connection.php');

  $result = pg_query_params($db, "UPDATE users SET favorites = array_append(favorites, $1) WHERE email = $2", array($id, $_SESSION['email']));

  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit();

 ?>
