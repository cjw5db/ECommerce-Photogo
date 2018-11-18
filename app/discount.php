<?php
session_start();

  if (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] == FALSE or !isset($_SESSION['email']) or $_SERVER["REQUEST_METHOD"] != "POST"){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }

  include('get_db_connection.php');

	$code = htmlspecialchars($_POST['code']);

  $result = pg_query_params($db, "SELECT array_to_json(usersclaimed) AS usersclaimed FROM discounts WHERE code = $1", array($code));
  if (pg_num_rows($result) == 0){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }

  $usersclaimed = json_decode(pg_fetch_result($result, 0, 'usersclaimed'));
  if (in_array($_SESSION['email'], $usersclaimed)){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
  }

  $result = pg_query_params($db, "UPDATE discounts SET usersclaimed = array_append(usersclaimed, $1) WHERE code = $2", array($_SESSION['email'], $code));

  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit();

 ?>
