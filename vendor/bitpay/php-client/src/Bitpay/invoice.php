<?php
  require __DIR__.'/../../../../autoload.php';

  $storageEngine = new \Bitpay\Storage\FilesystemStorage();
  $privateKey    = $storageEngine->load('/tmp/bitpay.pri');
  $publicKey     = $storageEngine->load('/tmp/bitpay.pub');
  $client        = new \Bitpay\Client\Client();
  $network       = new \Bitpay\Network\Testnet();
  $adapter       = new \Bitpay\Client\Adapter\CurlAdapter();
  $client->setPrivateKey($privateKey);
  $client->setPublicKey($publicKey);
  $client->setNetwork($network);
  $client->setAdapter($adapter);
echo $privateKey;
echo $publicKey;
  $token = new \Bitpay\Token();
  $token->setToken($_SESSION['token']);

  $client->setToken($token);

  $invoice = new \Bitpay\Invoice();
  $buyer = new \Bitpay\Buyer();

  $buyer->setEmail($_SESSION['email']);
  
  $invoice->setBuyer($buyer);

  $item = new \Bitpay\Item();
  $item
    ->setCode('skuNumber')
    ->setDescription('General Description of Item')
    ->setPrice($_GET['price']);
  $invoice->setItem($item);

  $invoice->setCurrency(new \Bitpay\Currency('BTC'));

  try {
    echo "Creating invoice at BitPay now.".PHP_EOL;
    $client->createInvoice($invoice);
  } 
  catch (\Exception $e) {
    echo "Exception occured: " . $e->getMessage().PHP_EOL;
    $request  = $client->getRequest();
    $response = $client->getResponse();
    echo (string) $request.PHP_EOL.PHP_EOL.PHP_EOL;
    echo (string) $response.PHP_EOL.PHP_EOL;
    exit(1); // We do not want to continue if something went wrong
  }
echo 'Invoice "'.$invoice->getId().'" created, see '.$invoice->getUrl().PHP_EOL;
echo "Verbose details.".PHP_EOL;

?>
