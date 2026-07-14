<?php

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=cravely', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "TABLES:\n";
    foreach ($pdo->query('SHOW TABLES') as $row) {
        echo $row[0] . "\n";
    }
    echo "\nSHOW CREATE TABLE barista:\n";
    $stmt = $pdo->query('SHOW CREATE TABLE barista');
    $row = $stmt->fetch(PDO::FETCH_NUM);
    if ($row) {
        echo $row[1] . "\n";
    } else {
        echo "barista table not found\n";
    }
    echo "\nSHOW CREATE TABLE pesanan:\n";
    $stmt = $pdo->query('SHOW CREATE TABLE pesanan');
    $row = $stmt->fetch(PDO::FETCH_NUM);
    if ($row) {
        echo $row[1] . "\n";
    } else {
        echo "pesanan table not found\n";
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
}
