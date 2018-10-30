<?php
  session_start();
  $_SESSION['logged_in'] = False;
  $_SESSION['email'] = None;
  header('Location: index.php');
  exit();
?>
