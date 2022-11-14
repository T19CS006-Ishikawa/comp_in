<?php
/*
    //Composerでインストールしたライブラリを一括読み込み
    require_once __DIR__ . '/vendor/autoload.php';
    
    //アクセストークンを使いCurlHTTPClientをインスタンス化
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
    
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

require_once __DIR__ . '/vendor/autoload.php';

$input = file_get_contents('php://input');
$json = json_decode($input);

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('DzNOTsY/Ht98S9QxPPUNcjN5m85UvSY1lEpZyfyLN+RFcuUs2laRz664s33dV/DYK+Q1b4COWuJTxhs/NBc0KcTQG4Fe52Gz+rsdAWSLbFQ8m8FAHoP/gU7lwCg5vZlggPAQOZAkKOBa7iDDAc+xNAdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '9dd5b0db9baa14fcfb44558627c6fbeb']);

$event = $json->events[0];
if($event->type == 'message') {
    $messageData = $event->message;
    if($messageData->type == 'text') {
        if($messageData->text == '委員長') {
            $replyText = '月ノ美兎';
        } else if($messageData->text == '皇女') {
            $replyText = 'リゼ・ヘルエスタ';
        } else {
            $replyText = $messageData->text;
        }
    } else if($messageData->type == 'image') {
        $replyText = '画像';
    } else {
        $replyText = "テキスト・画像以外";
    }
}

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($replyText);
$response = $bot->replyMessage($event->replyToken, $textMessageBuilder);
return;
?>
