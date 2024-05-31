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
                            <p class="login-card-description">Create an account</p>
                            <form id="registrationForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="form-group">
                                    <label for="name" class="sr-only">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                </div>                               
                                <div class="form-group">
                                    <label for="lastname" class="sr-only">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="sr-only">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" required>
                                </div>
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
                                <div class="form-group mb-4">
                                    <label for="dui" class="sr-only">DUI</label>
                                    <input type="text" name="dui" id="dui" class="form-control" placeholder="DUI" required maxlength="10">
                                </div>
                                <!-- Campo oculto para salt y otros campos relacionados con el token -->
                                <input type="hidden" name="salt" id="salt">
                                <input type="hidden" name="token" id="token">
                                <input type="hidden" name="token_expiry" id="token_expiry">
                                <!-- Botón de registro -->
                                <input name="register" id="register" class="btn btn-block login-btn mb-4" type="submit" value="Register" required>
                            </form>
                            <p class="login-card-footer-text">Have already an account? <a href="login_view.php" class="text-reset">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
$conn = include_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $conn->prepare("INSERT INTO usuarios (name, lastname, username, password, address, dui, email, user_type) VALUES (:name, :lastname, :username, :password, :address, :dui, :email, :user_type)");

    $stmt->bindParam(':name', $_POST["name"], PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $_POST["lastname"], PDO::PARAM_STR);
    $stmt->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $stmt->bindParam(':address', $_POST["address"], PDO::PARAM_STR);
    $stmt->bindParam(':dui', $_POST["dui"], PDO::PARAM_STR);
    $stmt->bindParam(':email', $_POST["email"], PDO::PARAM_STR);
    $stmt->bindParam(':user_type', $_POST["user_type"], PDO::PARAM_STR);

    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    

    if (!preg_match("/^[a-zA-Z ]*$/", $name) || !preg_match("/^[a-zA-Z ]*$/", $lastname)) {
        echo "<p><script>Swal.fire({
            title: 'Invalid Name or Lastname',
            text: 'Please enter a valid name and lastname (only letters allowed).',
            icon: 'error',
            button: 'Close',
            });</script></p>";
        exit; 
    }

    
    if (!preg_match("/^[0-9-]*$/", $dui)) {
        echo "<p><script>Swal.fire({
            title: 'Invalid DUI',
            text: 'Please enter a valid DUI (only numbers and hyphen allowed).',
            icon: 'error',
            button: 'Close',
            });</script></p>";
        exit; 
    }


    if ($password !== $confirmPassword) {
        echo "<p><script>Swal.fire({
            title: 'Passwords do not match',
            text: 'Please make sure both passwords match.',
            icon: 'error',
            button: 'Close',
            });</script></p>";
        exit; 
    }
    
    $pgsql_check_username = "SELECT * FROM usuarios WHERE email = :email";
    $stmt_check_username = $conn->prepare($pgsql_check_username);
    $stmt_check_username->bindParam(':email', $_POST["email"], PDO::PARAM_STR);
    $stmt_check_username->execute();
    $username_count = $stmt_check_email->rowCount();

    if ($username_count > 0) {
        echo "<p><script>Swal.fire({
            title: 'Email already registered',
            text: 'This email is already associated with an account.',
            icon: 'error',
            button: 'Close',
            });</script></p>";
        exit; // Stop script execution if email is duplicated
    }

    $pgsql_check_username = "SELECT * FROM usuarios WHERE username = :username";
    $stmt_check_username = $conn->prepare($pgsql_check_username);
    $stmt_check_username->bindParam(':username', $_POST["username"], PDO::PARAM_STR);
    $stmt_check_username->execute();
    $username_count = $stmt_check_email->rowCount();

    if ($email_count > 0) {
        echo "<p><script>Swal.fire({
            title: 'Username already in use',
            text: 'This username is already in use.',
            icon: 'error',
            button: 'Close',
            });</script></p>";
        exit; 
    }

    $pgsql_check_dui = "SELECT * FROM usuarios WHERE dui = :dui";
    $stmt_check_dui = $conn->prepare($pgsql_check_dui);
    $stmt_check_dui->bindParam(':dui', $_POST["dui"], PDO::PARAM_STR);
    $stmt_check_dui->execute();
    $dui_count = $stmt_check_dui->rowCount();

    if ($dui_count > 0) {
        echo "<p><script>Swal.fire({
            title: 'DUI already registered',
            text: 'This DUI is already associated with an account.',
            icon: 'error',
            button: 'Close',
            });</script></p>";
        exit; 
    }

    // Hash 
    $encrypted_pass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (name, lastname, username, password, address, dui, card_number ,email) VALUES ('$name','$lastname','$username', '$encrypted_pass', '$address', '$dui','null','$email')";
    if ($conn->query($sql) === TRUE) {
        echo "<p><script>
        Swal.fire({
            title: 'Successful Registration',
            text: 'User registered successfully',
            icon: 'success',
            button: 'Close',
        }).then(() => {
            window.location.href = 'login_view.php';
        });
    </script></p>";
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
        $(document).ready(function () {

            $('#dui').on('input', function () {
                var value = $(this).val().replace(/\D/g, '');
                var formattedValue = value.replace(/(\d{8})(\d{1,2})?/, '$1-$2');
                $(this).val(formattedValue);
            });


            $('#togglePassword, #toggleConfirmPassword').click(function () {
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


            $('#name, #lastname').on('input', function () {
                var regex = /^[a-zA-Z ]*$/;
                if (!regex.test($(this).val())) {
                    $(this).val('');
                }
            });
        });
    </script>
</body>

</html>