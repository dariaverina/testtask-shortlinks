<?php
require_once __DIR__ . '/src/Database.php';
require_once __DIR__ . '/src/UrlShortener.php';

header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $shortener = new UrlShortener();
        $shortCode = $shortener->shortenUrl($url);

        if ($shortCode) {
            echo $shortCode;
        } else {
            echo 'Error: Unable to shorten URL.';
        }
    } else {
        echo 'Error: Invalid URL.';
    }
} else {
    echo 'Error: Invalid request method.';
}
?>
