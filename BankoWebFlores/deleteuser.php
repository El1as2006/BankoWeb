<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="package/dist/sweetalert2.css">
    <script src="package/dist/sweetalert2.min.js"></script>

    <title>Delete User</title>
</head>

<body>
    <?php
    session_start();
if (!isset($_SESSION['logged_admin']) || $_SESSION['logged_admin'] !== true) {
    header('Location: login_view.php');
    exit;

} else{ 



    if (!isset($_GET["id"])) {
        exit("No hay id");
    }

    $pgsql = include_once "conexion.php";
    $id = $_GET["id"];

    $stmt = $pgsql->prepare("DELETE FROM public.users WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>  
              Swal.fire({
                  title: 'Deleted Successfully',
                  text: 'User Deleted Successfully',
                  icon: 'success',
                  button: 'Close'
              }).then(function() {
                  window.location = 'Admin/edit_delete_view.php';
              });
            </script>";
    } else {
        echo "<script>
              Swal.fire({
                  title: 'Error Deleting',
                  text: 'User Not Deleted',
                  icon: 'error',
                  button: 'Close'
              }).then(function() {
                  window.location = 'Admin/edit_delete_view.php';
              });
            </script>";
        }
    }
    ?>
</body>
</html>