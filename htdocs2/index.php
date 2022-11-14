<?php

    //Composerでインストールしたライブラリを一括読み込み
    require_once__DIR__ . '/vendor/autoload.php';
    
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
    
    
    
?>
