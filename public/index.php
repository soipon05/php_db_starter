<?php

define('DB_DATABASE', 'dotinstall_db');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'password');
define('PDO_DSN', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);

try {
    // connect
    $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 1. exec(): 結果を返さない、安全なSQL
// bindValue: 値をバインドする
// bindParam: 変数への参照をbind

    // $stmt = $db->prepare("insert into users (name, score) values (?, ?)");
    // $stmt->execute(['taguchi', 44]);
    $stmt = $db->prepare("insert into users (name, score) values (?, ?)");
    // $stmt->execute([':name'=>'fkoji', 'score'=>94]);
    // $stmt->execute([':name'=>'fkoji', 'score'=>44]);
    // $stmt->execute([':name'=>'fkoji', 'score'=>54]);

    $name = 'taguchi';
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    // // 名前付きパラメータのときは第一引数に同じのを指定する
    // // $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    // $score = 23;
    // $stmt->bindValue(2, $score, PDO::PARAM_INT);
    // $stmt->execute();
    // $score = 44;
    // $stmt->bindValue(2, $score, PDO::PARAM_INT);
    // $stmt->execute();

    $stmt->bindParam(2, $score, PDO::PARAM_INT);
    $score = 52;
    $stmt->execute();
    $score = 33;
    $stmt->execute();


    // disconnect
    $db = null;

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}