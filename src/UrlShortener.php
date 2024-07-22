<?php

class UrlShortener
{
    private $db;
    private $baseUrl;

    public function __construct()
    {
        $this->db = new Database();
        $this->baseUrl = $this->getBaseUrl();
    }

    public function shortenUrl($url)
    {
        $shortCode = $this->generateShortCode();
        $this->db->saveUrl($url, $shortCode);
        return $this->baseUrl . '/' . $shortCode;
    }

    private function generateShortCode($length = 6)
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }

    private function getBaseUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $script = $_SERVER['SCRIPT_NAME'];
        $path = rtrim(dirname($script), '/\\');
        return $protocol . $host . $path;
    }
}
