<?php
  try{
    include('../vendor/bitpay/php-client/src/Bitpay/createKeys.php');
    include('../vendor/bitpay/php-client/src/Bitpay/pairWithMerchant.php');
    session_start();
    $_SESSION['token']=$persistThisValue;
    exit();
  }
  catch(Exception $e){
    
  }
?>
