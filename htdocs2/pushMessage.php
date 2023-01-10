<?php

define('ACCESSTOKEN', 'DzNOTsY/Ht98S9QxPPUNcjN5m85UvSY1lEpZyfyLN+RFcuUs2laRz664s33dV/DYK+Q1b4COWuJTxhs/NBc0KcTQG4Fe52Gz+rsdAWSLbFQ8m8FAHoP/gU7lwCg5vZlggPAQOZAkKOBa7iDDAc+xNAdB04t89/1O/w1cDnyilFU=');
define('SECRET', '9dd5b0db9baa14fcfb44558627c6fbeb');
define('USERID', 'U9efd3497669302c628518420a60ebe92');

/*

//CurlHTTPClientとシークレットを使い、LINE Botをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);

//LINE Message API がリクエストに付与した署名を取得
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

//署名が正当かチェック。正当であればリクエストをパースし配列へ
$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);

foreach ($events as $event){
//テキストを返信
$bot->replyText($event -> getReplyToken(),'TextMessage');
}

*/

//Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';
$input = file_get_contents('php://input');
$json = json_decode($input);

//アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(ACCESSTOKEN);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret'=>SECRET]);



//$testData = file_get_contents($filename);
$test = "テストメッセージです";

//$event = $json->events[0];


//以下応答BOTのためのコード
//＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿//
/*
 if($event->type == 'message') {
 $messageData = $event->message;
 if($messageData->type == 'text') {
 if($messageData->text == 'ガブリエル') {
 $replyText = 'ジェズス';
 } else if($messageData->text == 'マルティン') {
 $replyText = 'ウーデゴール';
 }else if($messageData->text == 'ケビン') {
 $replyText = 'デ・ブライネ';
 } else if($messageData->text == 'アーリング') {
 $replyText = "ハーランド";
 }else if($messageData->text == 'NCT'){
 $replyText = $test;
 }else {
 $replyText = $messageData->text;
 }
 } else if($messageData->type == 'image') {
 $replyText = '画像';
 } else {
 $replyText = "テキスト・画像以外";
 }
 }
 */
//＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿//

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($test);
$bot->pushMessage(USERID, $textMessageBuilder);
echo $test;
return;
?>