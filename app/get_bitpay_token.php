<?php
  try{
    include('../vendor/bitpay/php-client/src/Bitpay/createKeys.php');
    include('../vendor/bitpay/php-client/src/Bitpay/pairWithMerchant.php');
    include('get_db_connection.php');
    $tokenArr = array(
      'token' => $persistThisValue);
    $conditionArr = array(
      'email' => $_SESSION['email']);
    pg_update($db, "users", $tokenArr, $conditionArr);
  }
  catch(Exception $e){

  }
?>
