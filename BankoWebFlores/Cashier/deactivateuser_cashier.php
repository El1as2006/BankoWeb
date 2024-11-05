<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="package/dist/sweetalert2.css">
    <script src="package/dist/sweetalert2.min.js"></script>

    <title>Deactivate User</title>
</head>

<body>
    <?php

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login_view.php');
    exit;
}

    if (!isset($_GET["id"])) {
        exit("No hay id");
    }

    $pgsql = include_once "conexion.php";
    $id = $_GET["id"];
    
    $stmt = $pgsql->prepare("UPDATE public.users SET state = 0 WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>  
              Swal.fire({
                  title: 'Deactivated Successfully',
                  text: 'User deactivated successfully.',
                  icon: 'success',
                  button: 'Close'
              }).then(function() {
                  window.location = 'edit_delete_view_cashier.php';
              });
            </script>";
    } else {
        echo "<script>
              Swal.fire({
                  title: 'Error Deactivating',
                  text: 'User could not be deactivated.',
                  icon: 'error',
                  button: 'Close'
              }).then(function() {
                  window.location = 'edit_delete_view_cashier.php';
              });
            </script>";
    }
    ?>
</body>
</html>
