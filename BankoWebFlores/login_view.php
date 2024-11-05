<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name=”viewport” content=”width=device-width, initial-scale=1.0”>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="package/dist/sweetalert2.css">
  <script src="package/dist/sweetalert2.min.js"></script>
  <style>
    .containerr {
      width: 40%;
      /* Ancho por defecto del contenedor */
      max-width: 1200px;
      /* Ancho máximo del contenedor */
      margin: 0 auto;
      /* Centrar el contenedor */
    }
    /* For screens 768px and larger */
    @media (max-width: 768px) {
      .containerr {
        width: 90%;
        /* Ancho aumentado para pantallas pequeñas */
      }
    }
    @media (max-width: 768px) {
      .responsive-div {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
      }
    }
  </style>
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="containerr" >
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-12 d-flex ">
            <div class="card-body responsive-div" style="display: flex;
                                            flex-direction: column;
                                            align-items: center;">
              <div class="brand-wrapper">
                <img src="assets/images/banko logos-03.png" alt="logo" class="logo">
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
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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

    // Get form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the user by username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // Get the result of the query
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      // Check if the user is active
      if ($user['state'] == 0) {
        echo "<script>
                    Swal.fire({
                        title: 'User Deactivated',
                        text: 'Please contact the administrator for more information.',
                        icon: 'error',
                        button: 'Close'
                    }).then(function() {
                        window.location = 'login_view.php';
                    });
                  </script>";
        exit;
      }

      // Verify password
      if (password_verify($password, $user['pass'])) {
        $_SESSION['username'] = $user['username'];

        switch ($user['rol']) {
          case 1: // Admin
            $_SESSION["logged_admin"] = true;
            $_SESSION['rol'] = 'Admin';
            header('Location: Admin/index_view.php');
            exit();
          case 2: // Cashier
            $_SESSION["logged_in"] = true;
            $_SESSION['rol'] = 'Cashier';
            header('Location: Cashier/index_view_cashier.php');
            exit();
          case 3: // Restricted
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