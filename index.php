<?php
require_once __DIR__ . '/src/Database.php';
require_once __DIR__ . '/src/UrlShortener.php';

try {
    $db = new Database();
    $db->checkTableExists('urls');
} catch (Exception $e) {
    die('Database or table not found. Please run <a href="install.php">install.php</a> to initialize the database.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form id="shortenForm">
            <input type="text" id="urlInput" placeholder="Enter URL" required>
            <button type="button" onclick="shortenUrl()">Shorten</button>
        </form>
        <div id="result"></div>
    </div>

    <script>
        function shortenUrl() {
            const url = document.getElementById('urlInput').value;

            fetch('shorten.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'url=' + encodeURIComponent(url)
            })
            .then(response => response.text())
            .then(data => {
                const resultDiv = document.getElementById('result');
                const baseUrl = window.location.origin + '/';

                // Очистить предыдущий результат
                resultDiv.innerHTML = '';

                if (data.startsWith('Error:')) {
                    resultDiv.innerHTML = `<p class="error">${data}</p>`;
                } else {
                    const shortUrl = data.trim();
                    resultDiv.innerHTML = `<p>Shortened URL:</p><a href="${shortUrl}" target="_blank">${shortUrl}</a>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('result').innerHTML = '<p class="error">Error occurred while shortening URL.</p>';
            });
        }
    </script>
</body>
</html>
