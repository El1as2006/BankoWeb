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

    return "Languages/" . $_SESSION['lang'] . ".php";
}

require get_language_file();
function lang($str)
{
    global $lang;
    if (!empty($lang[$str])) {
        return $lang[$str];
    }
}