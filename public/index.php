<?php

define('DB_DATABASE', 'dotinstall_db');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'password');
define('PDO_DSN', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);

try {
    // connect
    $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // select
    // $stmt = $db->query("select * from users");
    // $stmt = $db->prepare("select score from users where score > ?");

    // nameにtを含む人を探す条件分を書く、likeの指定はexecute(この中ですること)
    // $stmt = $db->prepare("select name from users where name like > ?");
    // $stmt->execute(['%t%']);

    // executeの値は基本的に文字列で返されるのでlimitの後の？はそこをうまく読み取ってくれないのでbindValueを使う
    $stmt = $db->prepare("select score from users order by score desc limit ?");
    $stmt->bidnValue(1, 1, PDO::PARAM_INT);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        var_dump($user);
    }

    $stmt->rowCount() . "records found.";


    // disconnect
    $db = null;

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}