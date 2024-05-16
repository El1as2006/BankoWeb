<?php
$conn = include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    $sql = "SELECT token,name FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo "<script>
                Swal.fire({
                    title: 'Email Not Found',
                    text: 'The provided email address is not associated with any account.',
                    icon: 'error',
                    button: 'Close',
                });
              </script>";
    } else {
        $nombre = $row["name"];
        $token = $row["token"];

        $asunto = "Password Reset";
        $cuerpo = "Hello,\n\n";
        $cuerpo .= "You have requested to reset your password. Please click the link below to reset your password:\n";
        $cuerpo .= $token;
        $cuerpo .= "localhost/BankoV1.3Ander/confirmationemail_view.php?email=" . urlencode($email) . "\n\n";
        $cuerpo .= "If you did not request this, please ignore this email and your password will remain unchanged.\n";

        include "funcs/funcs.php";

        if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {
            echo "<script>
                    Swal.fire({
                        title: 'Password Reset Email Sent',
                        text: 'An email with instructions to reset your password has been sent to $email.',
                        icon: 'success',
                        button: 'Close',
                    }).then(() => {
                        window.location.href = 'confirmationemail_view.php?email=" . urlencode($email) . "';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Email Sending Failed',
                        text: 'Failed to send password reset token. Please try again later.',
                        icon: 'error',
                        button: 'Close',
                    });
                  </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Forget password</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="package/dist/Sweetalert2.css">
    <script src="package/dist/Sweetalert2.min.js"></script>
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
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div>
              <p class="login-card-description">I have forgotten my password</p>
              <p class="login-card-footer-text">Enter your email to get the recovery email</p>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                  </div>
                  <input name="recovery" id="recovery" class="btn btn-block login-btn mb-4" type="submit" value="Send recovery email">
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
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
  
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>