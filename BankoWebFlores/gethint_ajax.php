<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$conn = require('conexion.php');

// Verificar si se ha enviado un valor de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['busqueda'])) {
    // Obtener y limpiar el valor de búsqueda
    $consultaBusqueda = htmlspecialchars($_POST['busqueda']);
	echo($consultaBusqueda);

    // Preparar consulta SQL para buscar usuarios que coincidan con el valor de búsqueda
    $stmt = $conn->prepare("SELECT * FROM users WHERE name LIKE :busqueda OR username LIKE :busqueda");
    $stmt->bindValue(':busqueda', '%' . $consultaBusqueda . '%', PDO::PARAM_STR);
    $stmt->execute();
    
    // Obtener resultados de la consulta
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Construir el mensaje de respuesta
    $mensaje = "";

    if ($resultados) {
        $mensaje .= 'Resultados para <strong>' . $consultaBusqueda . '</strong><br>';
        foreach ($resultados as $resultado) {
            $nombre = htmlspecialchars($resultado['name']);
            $apellido = htmlspecialchars($resultado['username']);
            $edad = htmlspecialchars($resultado['dui']);

            $mensaje .= '
            <p>
            <strong>Nombre:</strong> ' . $nombre . '<br>
            <strong>Apellido:</strong> ' . $apellido . '<br>
            <strong>Edad:</strong> ' . $edad . '<br>
            </p>';
        }
    } else {
        $mensaje = "<p>No hay ningún usuario con ese nombre y/o apellido</p>";
    }

    echo $mensaje;
}	
