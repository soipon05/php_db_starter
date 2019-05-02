<?php

define('DB_DATABASE', 'dotinstall_db');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'password');
define('PDO_DSN', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);

class User {
    public $id;
    public $name;
    public $score;
    public function show() {
        echo "$this->name ($this->score)";
    }
}

try {
    // connect
    $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // update
    $stmt = $db->prepare("update users set score = :score where name = :name");
    $stmt->execute([
        ':score' => 100,
        ':name'  => 'taguchi'
    ]);
    echo 'row updated: ' . $stmt->rowCount();

    // delete
    $stmt = $db->prepare("delete from users where name = :name");
    $stmt->execute([
        ':name' => 'dotinstall'
    ]);
    echo 'row deleted: ' . $stmt->rowCount();


    // disconnect
    $db = null;

} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}