<?php





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
echo SECRET;
return;
?>