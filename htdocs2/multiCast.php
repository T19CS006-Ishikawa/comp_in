<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content = "text/html;charset=UTF-8">
</head>
<form action = "./multiCast.php"	method="POST">
<input type = "submit" value ="再送信">
</form>
</body>
</html>
<?php
define('ACCESSTOKEN', 'DzNOTsY/Ht98S9QxPPUNcjN5m85UvSY1lEpZyfyLN+RFcuUs2laRz664s33dV/DYK+Q1b4COWuJTxhs/NBc0KcTQG4Fe52Gz+rsdAWSLbFQ8m8FAHoP/gU7lwCg5vZlggPAQOZAkKOBa7iDDAc+xNAdB04t89/1O/w1cDnyilFU=');
define('SECRET', '9dd5b0db9baa14fcfb44558627c6fbeb');
//define('USERID', 'U9efd3497669302c628518420a60ebe92');


//Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';
$json_string = file_get_contents('php://input');
$json_object = json_decode($json_string);

$event_type     = $json_object->{"events"}[0]->{"type"};
$userId         = $json_object->{"events"}[0]->{"source"}->{"userId"};


if($event_type === "follow" || $event_type === "unfollow"){
    file_put_contents("follow.log", $event_type . " " .$userId . "\n", FILE_APPEND);
    exit;
}

//アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(ACCESSTOKEN);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret'=>SECRET]);

//＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿//
$path = 'https://app-for-lms.herokuapp.com/csvData/push.txt';
$data = file_get_contents($path);
echo $data;
//＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿//

$message = $data;

$replyToken     = $json_object->{"events"}[0]->{"replyToken"};
//$message_text   = $json_object->{"events"}[0]->{"message"}->{"text"};
//$message_type   = $json_object->{"events"}[0]->{"message"}->{"type"};

$response_format_text = array( "type" => 'text', "text" => $message );
$post_data = array( "replyToken" => $replyToken, "messages" => [$response_format_text] );

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $post_data, JSON_UNESCAPED_UNICODE ));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . ACCESSTOKEN
));
curl_exec($ch);
curl_close($ch);
return;
?>