<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="package/dist/sweetalert2.css">
  <script src="package/dist/sweetalert2.min.js"></script>
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container" style="width: 40%;">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-12 d-flex ">
            <div class="card-body" style="display: flex;
                                            flex-direction: column;
                                            align-items: center;">
              <div class="brand-wrapper">
                <img src="assets/images/banko logos-03.png" alt="logo" class="logo" >
              </div>
              <p class="login-card-description">Sign into your account</p>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                  <label for="username" class="sr-only">Username</label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">Password</label>
                  <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary height1" type="button" id="togglePassword">
                        <i class="mdi mdi-eye"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
 <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST['username']) || empty($_POST['password'])) {
    echo "<script>
            Swal.fire({
                title: 'Empty Fields',
                text: 'Please fill in both username and password',
                icon: 'error',
                button: 'Close'
            });
          </script>";
    exit; 
}
    $conn = include 'conexion.php';

    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consultar el usuario por nombre de usuario
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // Obtener el resultado de la consulta
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user) {

        if (password_verify($password, $user['pass'])) {

            $_SESSION['username'] = $user['username'];

            switch ($user['rol']) {
                case 1: // Admin
                    $_SESSION['rol'] = 'Admin';
                    header('Location: index_view.php');
                    exit();
                case 2: 
                    $_SESSION['rol'] = 'Cashier';
                    header('Location: index_view_cashier.php');
                    exit();
                case 3: 
                    echo "<script>
                            Swal.fire({
                                title: 'Access Denied',
                                text: 'You do not have permission to access this page',
                                icon: 'error',
                                button: 'Close'
                            }).then(function() {
                                window.location = 'login_view.php';
                            });
                          </script>";
                    break;
                default:
                    echo "<script>
                            Swal.fire({
                                title: 'Unknown Role',
                                text: 'Please contact the administrator',
                                icon: 'error',
                                button: 'Close'
                            }).then(function() {
                                window.location = 'login_view.php';
                            });
                          </script>";
            }
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Wrong Password',
                        text: 'Please check your password',
                        icon: 'warning',
                        button: 'Close'
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    title: 'User Not Found',
                    text: 'Please check your username',
                    icon: 'error',
                    button: 'Close'
                });
              </script>";
    }


    $conn = null;
}
?>


  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#togglePassword').click(function () {
        var passwordInput = $('#password');
        var passwordFieldType = passwordInput.attr('type');
        if (passwordFieldType === 'password') {
          passwordInput.attr('type', 'text');
          $(this).find('i').removeClass('mdi-eye').addClass('mdi-eye-off');
        } else {
          passwordInput.attr('type', 'password');
          $(this).find('i').removeClass('mdi-eye-off').addClass('mdi-eye');
        }
      });
    });
  </script>
</body>

</html>