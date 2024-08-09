<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = include 'conexion.php';

if(isset($_POST['letra'])) {
  $letra = ($_POST['letra']); // Escapar para evitar inyección SQL
  // Query SQL con filtro por letra
  $sql = "SELECT * FROM users WHERE name LIKE '%$letra%'";
  
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {

    require "funcs/funcs.php";
    $decrypted_dui = decryptPayload($row['dui']);

    echo "ID: " . $row["id"]. " - Nombre: " . $row["name"]. " - Dui: " . $decrypted_dui. "<br>";
}

}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form accept-charset="utf-8" method="post">
        <input type="text" name="letra" id="letra" value="" placeholder="" maxlength="30" autocomplete="off" />
    </form>
</body>
</html>