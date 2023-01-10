<?php

define('ACCESSTOKEN', 'DzNOTsY/Ht98S9QxPPUNcjN5m85UvSY1lEpZyfyLN+RFcuUs2laRz664s33dV/DYK+Q1b4COWuJTxhs/NBc0KcTQG4Fe52Gz+rsdAWSLbFQ8m8FAHoP/gU7lwCg5vZlggPAQOZAkKOBa7iDDAc+xNAdB04t89/1O/w1cDnyilFU=');
define('SECRET', '9dd5b0db9baa14fcfb44558627c6fbeb');
define('USERID', 'U9efd3497669302c628518420a60ebe92');




//Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';
$input = file_get_contents('php://input');
//$json = json_decode($input);

//アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(ACCESSTOKEN);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret'=>SECRET]);



//$testData = file_get_contents($filename);
$test = "テストメッセージです";

//$event = $json->events[0];



$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($test);
$bot->pushMessage(USERID, $textMessageBuilder);
echo $test;
return;
?>