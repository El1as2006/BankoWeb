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
    if (!isset($_GET["id"])) {
        exit("No hay id");
    }

    $pgsql = include_once "conexion.php";
    $id = $_GET["id"];
    
    $stmt = $pgsql->prepare("UPDATE public.users SET state = 1 WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>  
              Swal.fire({
                  title: 'Activated Successfully',
                  text: 'User Activated successfully.',
                  icon: 'success',
                  button: 'Close'
              }).then(function() {
                  window.location = 'edit_delete_view.php';
              });
            </script>";
    } else {
        echo "<script>
              Swal.fire({
                  title: 'Error Activating',
                  text: 'User could not be Activated.',
                  icon: 'error',
                  button: 'Close'
              }).then(function() {
                  window.location = 'edit_delete_view.php';
              });
            </script>";
    }
    ?>
</body>
</html>
