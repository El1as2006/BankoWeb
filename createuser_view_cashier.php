<?php
require 'createuser_lang.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="package/dist/sweetalert2.css">
  <script src="package/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Request User</title>

    <style>
        body {
            opacity: 0;
        }
    </style>
    <script src="js/settings.js"></script>
    <!-- END SETTINGS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-120946860-7');
    </script>
</head>

<body>


<?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = include_once("conexion.php");
        
    

        $name = htmlspecialchars(trim($_POST["name"]));
        $lastname = htmlspecialchars(trim($_POST["lastname"]));
        $username = htmlspecialchars(trim($_POST["username"]));
        $password = htmlspecialchars(trim($_POST["password"]));
        $confirmPassword = htmlspecialchars(trim($_POST["confirm_password"]));
        $address = htmlspecialchars(trim($_POST["address"]));
        $dui = htmlspecialchars(trim($_POST["dui"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $user_type = (int)$_POST["user_type"];
        $status = "waiting"; 

        if (empty($name) || empty($lastname) || empty($username) || empty($password) || empty($address) || empty($dui) || empty($email)) {
            echo "<script>Swal.fire({ title: 'Error', text: 'All fields are required.', icon: 'error', button: 'Close' });</script>";
            exit;
        }


        if (!preg_match("/^[a-zA-Z ]*$/", $name) || !preg_match("/^[a-zA-Z ]*$/", $lastname)) {
            echo "<script>Swal.fire({ title: 'Error', text: 'Please enter a valid name and lastname (only letters allowed).', icon: 'error', button: 'Close' });</script>";
            exit;
        }


        if (!preg_match("/^[0-9-]*$/", $dui)) {
            echo "<script>Swal.fire({ title: 'Error', text: 'Please enter a valid DUI (only numbers and hyphen allowed).', icon: 'error', button: 'Close' });</script>";
            exit;
        }

        if ($password !== $confirmPassword) {
            echo "<script>Swal.fire({ title: 'Error', text: 'Passwords do not match.', icon: 'error', button: 'Close' });</script>";
            exit;
        }

        $sql = "SELECT * FROM users WHERE email = :email OR username = :username OR dui = :dui";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email, ':username' => $username, ':dui' => $dui]);
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            if ($existing_user['email'] === $email) {
                echo "<script>Swal.fire({ title: 'Error', text: 'This email is already associated with an account.', icon: 'error', button: 'Close' });</script>";
            } elseif ($existing_user['username'] === $username) {
                echo "<script>Swal.fire({ title: 'Error', text: 'This username is already in use.', icon: 'error', button: 'Close' });</script>";
            } elseif ($existing_user['dui'] === $dui) {
                echo "<script>Swal.fire({ title: 'Error', text: 'This DUI is already associated with an account.', icon: 'error', button: 'Close' });</script>";
            }
            exit;
        }


        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $hashed_password = '$2a$' . substr($hashed, 4);

        //-------------------------------------------------------------------
        require 'funcs/funcs.php';

$encrypted_dui = encryptPayload ($dui);
$encrypted_address = encryptPayload ($address);
$encrypted_email = encryptPayload ($email);

//-------------------------------------------------------------------

        $sql = "INSERT INTO user_requests (name, lastname, username, password, address, dui, email, user_type, status) VALUES (:name, :lastname, :username, :password, :address, :dui, :email, :user_type, :status)";
        $stmt = $conn->prepare($sql);
        $params = [
            ':name' => $name,
            ':lastname' => $lastname,
            ':username' => $username,
            ':password' => $hashed_password,
            ':address' => $encrypted_address,
            ':dui' => $encrypted_dui,
            ':email' => $encrypted_email,
            ':user_type' => $user_type,
            ':status' => $status
        ];

        if ($stmt->execute($params)) {
            echo "<script>Swal.fire({ title: 'Success', text: 'User creation request sent.', icon: 'success', button: 'Close' });</script>";
        } else {
            echo "<script>Swal.fire({ title: 'Error', text: 'There was an error sending the request.', icon: 'error', button: 'Close' });</script>";
        }
        $dui = str_replace('-', '', $dui);
    }
   
    ?>

    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a class='sidebar-brand' href='index_view.php'>
                <img src="assets/images/banko logos-03.png" width="130px" />
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">

                    <img src="img/avatars/profile-use.png" class="img-fluid rounded-circle mb-2" alt="" />
                    <div class="fw-bold"><?php
                                            echo ($_SESSION['username']); ?></div>
                    <small>Cashier</small>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>
                    <li class="sidebar-item">
						<a class='sidebar-link' href='index_view_cashier.php'>
							<i class="align-middle me-2" data-feather="home"></i> <span class="align-middle"><?= lang("Principal Index") ?></span>
						</a>
					</li>
					<li class="sidebar-item">
                        <a class='sidebar-link' href='edit_delete_view_cashier.php'>
                            <i class="align-middle me-2" data-feather="users"></i> <span class="align-middle"><?= lang("Edit/Delete Users"); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingaccounts_cashier.php'>
                            <i class="align-middle me-2 far fa-fw fa-dollar-sign"></i> <span class="align-middle"><?= lang("Add Bank Account") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingcards_cashier.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Add Debit/Credit Card") ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-theme">
                <a class="sidebar-toggle d-flex me-2">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="d-none d-sm-inline-block"></div>



                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="align-middle fas fa-language"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="createuser_view_cashier.php?lang=en"><i class="align-middle me-1 fas fa-fw fa-user"></i> English</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="createuser_view_cashier.php?lang=es"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="align-middle fas fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i><?= lang("Sign out") ?></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content">
                <div class="container-fluid">

                    <div class="header">
                        <h1 class="header-title">
                            <?= lang("Create User") ?>
                        </h1>
                        <nav aria-label="breadcrumb">

                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><?= lang("Create User") ?></h5>
                                    <h6 class="card-subtitle text-muted"></h6>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name"><?= lang("Name") ?></label>
                                                <input type="name" class="form-control" id="name" name="name" placeholder=<?= lang("Name") ?>>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="lastname"><?= lang("Lastname") ?></label>
                                                <input type="lastname" class="form-control" id="lastname" name="lastname" placeholder=<?= lang("Lastname") ?>>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="username"><?= lang("Username") ?></label>
                                                <input type="username" class="form-control" id="username" name="username" placeholder=<?= lang("Username") ?>>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="password"><?= lang("Password") ?></label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder=<?= lang("Password") ?>>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="confirm_password"><?= lang("Confirm Password") ?></label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder=<?= lang("Confirm Password") ?>>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address"><?= lang("Address") ?></label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder=<?= lang("Address") ?>>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="email@gmail.com">
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="dui">DUI</label>
                                                <input type="text" class="form-control" id="dui" name="dui" placeholder="00000000-0">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="inputState"><?= lang("User type") ?></label>
                                                <select id="inputState" name="user_type" class="form-control">
                                             <option value="3"><?= lang("Client") ?></option>
                                               </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                        </div>
                                        <!-- <input type="submit" value="submite" class="btn btn-primary"> -->
                                        <button type="submit" class="btn btn-primary"><?= lang("Send request") ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-8 text-start">
                            <ul class="list-inline">
                            </ul>
                        </div>
                        <div class="col-4 text-end">
                            <p class="mb-0">
                                &copy; 2024 PTC - <a class='text-muted' href='index_view.php'>Banko</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <svg width="0" height="0" style="position:absolute">
        <defs>
            <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
                <path d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
                </path>
            </symbol>
        </defs>
    </svg>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cardNumberInput = document.getElementById('card_number');

            cardNumberInput.addEventListener('input', function(e) {
                // Sirve para eliminar caracteres no permitidos
                const currentValue = e.target.value.replace(/\D/g, '');

                // este aplica mascara al numero de tarjeta
                let maskedValue = '';
                for (let i = 0; i < currentValue.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        maskedValue += '-';
                    }
                    maskedValue += currentValue[i];
                }

                // esta linea limita numero de tarjeta a 16 caracteres
                maskedValue = maskedValue.slice(0, 19);

                // Actualiza el valor del campo de entrada
                e.target.value = maskedValue;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const duiInput = document.getElementById('dui');

            duiInput.addEventListener('input', function(e) {
                // Esta linea elimina caracteres no permitidos
                const currentValue = e.target.value.replace(/\D/g, '');

                // Aplica mascara al dui del usuario
                let maskedValue = '';
                for (let i = 0; i < currentValue.length; i++) {
                    if (i === 8) {
                        maskedValue += '-';
                    }
                    maskedValue += currentValue[i];
                }

                // limita el dui a 10 caracteres
                maskedValue = maskedValue.slice(0, 10);

                // actualiza el valor del campo de entrada
                e.target.value = maskedValue;
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>