<?php
$storageEngine = new \Bitpay\Storage\FilesystemStorage();
$privateKey = $storageEngine->load('/tmp/bitpay.pri');
$publicKey = $storageEngine->load('/tmp/bitpay.pub');
$sin = \Bitpay\SinKey::create()->setPublicKey($publicKey)->generate();

$client = new \Bitpay\Client\Client();

$network = new \Bitpay\Network\Testnet();

$adapter = new \Bitpay\Client\Adapter\CurlAdapter();

$client->setPrivateKey($privateKey);
$client->setPublicKey($publicKey);
$client->setNetwork($network);
$client->setAdapter($adapter);

$pairingCode = 'nNCSZE8';
$token = $client->createToken(
 array(
 'pairingCode' => $pairingCode,
 'label' => 'client token',
 'id' => (string) $sin,
 )
);
$persistThisValue = $token->getToken();
?>
