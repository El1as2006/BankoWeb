<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function get_language_file()
{
    $_SESSION['lang'] = $_SESSION['lang'] ?? "en";
    $_SESSION['lang'] = $_GET['lang'] ?? $_SESSION['lang'];

    // Usar ruta absoluta
    return __DIR__ . "/Languages/" . $_SESSION['lang'] . ".php";
}

$lang_file = get_language_file();

// Verificar si el archivo existe antes de requerirlo
if (!file_exists($lang_file)) {
    die("Error: El archivo de idioma no existe: " . $lang_file);
}

require $lang_file;

function lang($str)
{
    global $lang;
    if (!empty($lang[$str])) {
        return $lang[$str];
    }
}
?> 