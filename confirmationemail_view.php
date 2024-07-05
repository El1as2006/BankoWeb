<?php

$conn = include("conexion.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $conn->prepare("SELECT token FROM usuarios WHERE id_user = ?");
    $stmt->bind_param("i", $id_usuario); 
    $id_usuario = 1; 
    $stmt->execute();
    $stmt->bind_result($token_correcto);
    $stmt->fetch();
    $stmt->close();
 
    $token_ingresado = $_POST["token"];

    if ($token_ingresado == $token_correcto) {

        echo "<script>
            Swal.fire({
                title: 'Token Correct',
                text: 'The entered token is correct.',
                icon: 'success',
                button: 'Close',
            }).then(() => {
                window.location.href = 'newpassword_view.php';
            });
        </script>";
        exit;
    } else {
        // Mostrar una alerta de que el token es incorrecto
        echo "<script>
            Swal.fire({
                title: 'Incorrect Token',
                text: 'The entered token is incorrect. Please try again.',
                icon: 'error',
                button: 'Close',
            });
        </script>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Confirmation Email</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="package/dist/sweetalert2.css">
  <script src="package/dist/sweetalert2.min.js"></script>
  
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/IMG_3215.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
            <button id="btnCerrar" href="login_view.php" style="float: right" class="button">Back</button>
              <div class="brand-wrapper">
                <img src="assets/images/banko logos-03.png" width="150px" />
              </div>
              <p class="login-card-description">Please enter your token</p>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                  <div class="form-group mb-4">
                    <label for="token" class="sr-only">Token</label>
                    <div class="input-group">
                        <input type="token" name="token" id="token" class="form-control" placeholder="Token">
                        <div class="input-group-append">
                        </div>
                    </div>
                  </div>
                  <input name="recovery" id="recovery" class="btn btn-block login-btn mb-4" type="submit" value="Check Token"> 
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
<style>
body {
  font-family: Arial, sans-serif;
}

.modulo {
  width: 300px;
  padding: 20px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

button {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
.button{
  background-color: black;
  font-weight: bold;
}
</style>
</html>