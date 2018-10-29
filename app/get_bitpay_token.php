<?php
  foreach (glob("../vendor/bitpay/php-client/src/Bitpay/*.php") as $filename)
  {
    include $filename;
  }
  // require_once('../vendor/bitpay/php-client/src/Bitpay/PrivateKey.php');
  // require_once('../vendor/bitpay/php-client/src/Bitpay/PublicKey.php');
  // require_once('../vendor/bitpay/php-client/src/Bitpay/Key.php');
  $privateKey = new PrivateKey('/tmp/bitpay.pri');
  $privateKey->generate();

  $ch = curl_init();
  $fields = [
    'label' => 'My Bitpay Client',
    'id' => '486500dc-2b90-49ed-a11c-4e971562d41f',
    'facade' => 'merchant'
  ];

  $fields_string = http_build_query($fields);

  curl_setopt($ch, CURLOPT_URL, "http://bitpay.com/tokens");
  curl_setopt($ch,CURLOPT_POST, count($fields));
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

  $result = curl_exec($ch);
  echo curl_getinfo($ch)['url'];
  echo $result;
?>
