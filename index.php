
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

$client = new Client((new Configuration(
    '__MODE__',
    '__API_VERSION__',
    '__USERNAME__',
    '__TOKEN__'
)));

$list = $client->domain->list();
var_dump($list);
?>
</pre>
</body>
</html>
