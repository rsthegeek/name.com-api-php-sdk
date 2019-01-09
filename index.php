<?php

require __DIR__.'/vendor/autoload.php';

use lisi4ok\NameDotCom\Configuration;
use lisi4ok\NameDotCom\Client;

$username = '__USERNAME__';
$token = '__TOKEN__';
$configuration = new Configuration(
    'test',
    '4',
    $username . '-test',
    $token
);
$client = new Client($configuration);

//$client = new Client((new Configuration(
//    'test',
//    '4',
//    $username . '-test',
//    $token
//)));

$list = $client->domain()->list();


echo '<pre>';
var_dump($list);
die;
