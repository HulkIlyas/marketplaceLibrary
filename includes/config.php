<?php

session_start();

$supportedLanguages = ['en', 'fr', 'ar'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $supportedLanguages)) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = $_SESSION['lang'] ?? 'fr';

$translations = require __DIR__ . "/../lang/$lang.php";