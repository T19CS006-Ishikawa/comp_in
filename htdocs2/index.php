<?php

    //Composerでインストールしたライブラリを一括読み込み
    require_once__DIR__ . '/vendor/autoload.php';
    
    //POST メソッドで渡される値を取得、表示
    $inputString = file_get_contents('php://input');
    error_log($inputString);
?>
