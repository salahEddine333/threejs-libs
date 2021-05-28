<?php
$dsn = "mysql:host=localhost;dbname=kdmdb;";
$user = "root";
$pass = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {

    $db = new PDO($dsn, $user, $pass, $options);

} catch(PDOException $e) {

    echo $e->getMessage();

}