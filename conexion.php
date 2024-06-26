<?php

$servername = "Localhost";
$dbname = "bankodb";
$username = "flores";
$password = "123";

try {
  $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
  return $conn;
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
