<?php

$host = 'localhost';
$db   = 'diary_app_php';
$user = 'root';
$pass = 'root';
$port = 8889;

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    exit('DB接続失敗: ' . $e->getMessage());
}
