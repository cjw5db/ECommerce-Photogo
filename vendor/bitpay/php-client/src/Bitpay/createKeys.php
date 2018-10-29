<?php
require __DIR__.'/../../../../autoload.php';

$privateKey = new \Bitpay\PrivateKey('/tmp/bitpay.pri');
$privateKey->generate();

$publicKey = new \Bitpay\PublicKey('/tmp/bitpay.pub');
$publicKey->setPrivateKey($privateKey);
$publicKey->generate();

$storageEngine = new \Bitpay\Storage\FilesystemStorage();
$storageEngine->persist($privateKey);
$storageEngine->persist($publicKey);
?>
