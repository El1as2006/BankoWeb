<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function generateCode($limit){
    $code = '';
    for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
    return $code;
}
$n_account = generateCode(10);

$pgsql = include_once "conexion.php";

$user_id = $_GET["id"];

$hash_account = password_hash($n_account, PASSWORD_DEFAULT);
$hashed_account = '$2a$' . substr($hash_account, 4);

$stmt = $pgsql->prepare("INSERT INTO public.accounts
(owner_id, balance, accounttype, accountnumber)
VALUES( :owner_id, :balance, :accounttype, :accountnumber);");

$params = [
    ':owner_id' => $user_id,
    ':balance' => 0,
    ':accounttype' => 'savings',   
    ':accountnumber' => $hashed_account, 
];

$stmt->execute($params);

header("Location: addingcards.php");