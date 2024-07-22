<?php

class Database
{
    public $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../config.php';
        $dbConfig = $config['db'];

        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";

        try {
            $this->pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if ($e->getCode() == 1049) {
                die('Database not found. Please run <a href="install.php">install.php</a> to initialize the database.');
            } else {
                die('Connection failed: ' . $e->getMessage());
            }
        }
    }

    public function checkTableExists($tableName)
    {
        try {
            $result = $this->pdo->query("SELECT 1 FROM $tableName LIMIT 1");
        } catch (Exception $e) {
            die('Table not found. Please run <a href="install.php">install.php</a> to initialize the database.');
        }
    }

    public function saveUrl($url, $shortCode)
    {
        $stmt = $this->pdo->prepare('INSERT INTO urls (original_url, short_code) VALUES (:original_url, :short_code)');
        $stmt->execute(['original_url' => $url, 'short_code' => $shortCode]);
    }

    public function getUrlByShortCode($shortCode)
    {
        $stmt = $this->pdo->prepare('SELECT original_url FROM urls WHERE short_code = :short_code');
        $stmt->execute(['short_code' => $shortCode]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
