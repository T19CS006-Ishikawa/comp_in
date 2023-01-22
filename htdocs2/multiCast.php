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


if($event_type === "follow" ){
    file_put_contents("follow.txt", $userId.",",FILE_APPEND);
}


if($event_type === "unfollow"){
    $textfile = file_get_contents(__DIR__.'follow.txt');
    $id_array = explode(',',$textfile);
    if(in_array($userId,$id_array)){
        $pos = array_search($userId, $id_array);
        $userID_array = array_splice($id_array, $pos);
        for($num = 0;$num < count($userID_array)-1;$num++){
            if($num == 0){
                $text = $userID_array[$num];
            }
            else if($num == count($userID_array)-2){
                $text = $text.$userID_array[$num];
            }else{
                $text = $text.$userID_array[$num].',';
            }
        }
        file_put_contents("follow.txt",$text);
    }
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

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
$count = count($userID_array);
for($num = 0 ;$num < $count;$num++){
$bot->pushMessage($userID_array[$num], $textMessageBuilder);
}
echo $test;
return;
?>