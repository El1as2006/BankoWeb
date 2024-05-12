<?php
$host = "localhost";
$usuario = "root";
$contrasenia = "";
$base_de_datos = "banko";
$mysqli = new mysqli($host, $usuario, $contrasenia, $base_de_datos);
if ($mysqli->connect_errno) {
echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
return $mysqli;



// $host = '192.168.1.40';
// $dbname = 'bankoweb';
// $user = 'banko_user';
// $password = 'Info2024/*-';

// try {
//     $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully to the database.";
// } catch (PDOException $e) {
//     echo "Error: ". $e->getMessage();
// }
// return $conn;

