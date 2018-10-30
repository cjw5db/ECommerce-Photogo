<?php
  try{
    include('../vendor/bitpay/php-client/src/Bitpay/createKeys.php');
    include('../vendor/bitpay/php-client/src/Bitpay/pairWithMerchant.php');
    $_SESSION['token'] = $persistThisValue;
    exit();
  }
  catch(Exception $e){

  }
?>
