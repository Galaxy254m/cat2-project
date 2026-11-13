<?php
$dsn = "mysql:host=localhost;dbname=CAT2;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, 'cat2user', 'CHANGE_ME',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
} 
