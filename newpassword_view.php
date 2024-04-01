<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="package/dist/Sweetalert2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                            <div class="brand-wrapper">
                                <img src="assets/images/logo.svg" alt="logo" class="logo">
                            </div>
                            <p class="login-card-description">Enter your new password</p>
                            <form id="registrationForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary height1 " type="button" id="togglePassword">
                                                <i class="mdi mdi-eye center"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="confirmPassword" class="sr-only">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary height1" type="button" id="toggleConfirmPassword">
                                                <i class="mdi mdi-eye center"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo oculto para salt y otros campos relacionados con el token -->
                                <input type="hidden" name="salt" id="salt">
                                <input type="hidden" name="token" id="token">
                                <input type="hidden" name="token_expiry" id="token_expiry">
                                <!-- Botón de registro -->
                                <input name="register" id="register" class="btn btn-block login-btn mb-4" type="submit" value="Confirm your new password" required>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php

    $conn = include_once("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $confpass = mysqli_real_escape_string($conn, $_POST["confpassword"]);
        if (empty($pass) || empty($confpass)) {
            echo "<p><script>swal.fire({
                title: 'This field is empty',
                text: 'Empty Field',
                icon: 'warning',
                button: 'Close',
                });</script></p>";  
        } else
            $encrypted_pass = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios ( password) VALUES ('$encrypted_pass')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>
            <script>
            swal({
            title: 'Succesful Register',
            text: 'Password succesfully register',
            icon: 'success',
            button: 'Close',
            });
            </script>
            </p>"; 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
    ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#dui').on('input', function() {
                var value = $(this).val().replace(/\D/g, '');
                var formattedValue = value.replace(/(\d{8})(\d{1,2})?/, '$1-$2');
                $(this).val(formattedValue);
            });


            $('#togglePassword, #toggleConfirmPassword').click(function() {
                var passwordInput = $(this).closest('.input-group').find('input');
                var passwordFieldType = passwordInput.attr('type');
                if (passwordFieldType == 'password') {
                    passwordInput.attr('type', 'text');
                    $(this).find('i').removeClass('mdi-eye').addClass('mdi-eye-off');
                } else {
                    passwordInput.attr('type', 'password');
                    $(this).find('i').removeClass('mdi-eye-off').addClass('mdi-eye');
                }
            });
            $('#name, #lastname').on('input', function() {
                var regex = /^[a-zA-Z ]*$/;
                if (!regex.test($(this).val())) {
                    $(this).val('');
                }
            });
        });
    </script>
</body>
</html>