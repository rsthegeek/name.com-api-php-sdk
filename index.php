
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Name.COM API PHP SDK</title>
</head>
<body>
    <pre>
<?php
require __DIR__.'/vendor/autoload.php';

use lisi4ok\NameDotCom\Configuration;
use lisi4ok\NameDotCom\Client;

$configuration = new Configuration(
    'test',
    4,
    'cloudcart-test',
    '6dc82750574e5e15dfcff170e991209602d7fd37'
);
$client = new Client($configuration);

//$client = new Client((new Configuration(
//    'test',
//    '4',
//    'cloudcart-test',
//    '6dc82750574e5e15dfcff170e991209602d7fd37'
//)));

//$list = $client->domain()->list();

$a = $client->domain->find('liskoooo.biz');
var_dump($a);
?>
</pre>
</body>
</html>
<?php




exit;

// require __DIR__.'/vendor/autoload.php';

// use lisi4ok\NameDotCom\Configuration;
// use lisi4ok\NameDotCom\Client;

// $username = '__USERNAME__';
// $token = '__TOKEN__';
// $configuration = new Configuration(
//     'test',
//     '4',
//     $username . '-test',
//     $token
// );
// $client = new Client($configuration);

// //$client = new Client((new Configuration(
// //    'test',
// //    '4',
// //    $username . '-test',
// //    $token
// //)));

// $list = $client->domain()->list();


// echo '<pre>';
// var_dump($list);
// die;
