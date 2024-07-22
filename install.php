<?php
$config = require __DIR__ . '/config.php';

$dbConfig = $config['db'];
$dsn = "mysql:host={$dbConfig['host']};charset={$dbConfig['charset']}";
$user = $dbConfig['user'];
$password = $dbConfig['password'];

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS {$dbConfig['dbname']}");
    $pdo->exec("USE {$dbConfig['dbname']}");

    // Create table
    $sql = "
    CREATE TABLE IF NOT EXISTS urls (
        id INT AUTO_INCREMENT PRIMARY KEY,
        original_url TEXT NOT NULL,
        short_code VARCHAR(10) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ";
    $pdo->exec($sql);

    echo "Database and table initialized successfully.";
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
