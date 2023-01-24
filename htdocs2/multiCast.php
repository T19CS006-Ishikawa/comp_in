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

//アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(ACCESSTOKEN);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret'=>SECRET]);

//＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿//
$path = 'https://app-for-lms.herokuapp.com/csvData/push.txt';
$data = file_get_contents($path);
echo $data;

$message = $data;
//＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿//
$headers = [
'Authorization: Bearer ' . $channelToken,
'Content-Type: application/json; charset=utf-8',
];
$text = 'test2'; //メッセージテキスト
$post = [
    'messages' => [
            [
                'type' => 'text',
                'text' => $message,
            ],
         ],
];

$post = json_encode($post);

$ch = curl_init('https://api.line.me/v2/bot/message/broadcast'); //一斉送信
$options = [
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_HTTPHEADER => $headers,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_BINARYTRANSFER => true,
CURLOPT_HEADER => true,
CURLOPT_POSTFIELDS => $post,
];
curl_setopt_array($ch, $options);

$result = curl_exec($ch);
$errno = curl_errno($ch);
if ($errno) {
    return;
}

$info = curl_getinfo($ch);
$httpStatus = $info['http_code']; //200なら成功

$responseHeaderSize = $info['header_size'];
$body = substr($result, $responseHeaderSize); //エラーメッセージ等

echo $httpStatus . '_' . $body; //ログ出力
?>