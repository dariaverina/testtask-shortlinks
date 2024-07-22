<?php
require_once __DIR__ . '/src/Database.php';

if (!isset($_GET['code'])) {
    die('No code provided!');
}

$shortCode = $_GET['code'];
$db = new Database();

$row = $db->getUrlByShortCode($shortCode);

if ($row) {
    header('Location: ' . $row['original_url']);
    exit();
} else {
    echo 'URL not found!';
}
