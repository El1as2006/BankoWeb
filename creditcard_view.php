<?php
require 'createuser_lang.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
    <meta name="author" content="Bootlab">
    <link rel="stylesheet" href="package/dist/sweetalert2.css">
    <script src="package/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Credit Card</title>

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

        $limit_card = htmlspecialchars(trim($_POST["limit"]));

        if (empty($limit_card)) {
            echo "<script>swal({ title: 'All fields are required', text: 'Please fill in all fields.', icon: 'error', button: 'Close' });</script>";
            exit;
        }

        function generateCard($limit)
        {
            $code = '';
            for ($i = 0; $i < $limit; $i++) {
                $code .= mt_rand(0, 9);
            }
            return $code;
        }
        $n_account = generateCard(16);

        function generateCVV($limit)
        {
            $code = '';
            for ($i = 0; $i < $limit; $i++) {
                $code .= mt_rand(0, 9);
            }
            return $code;
        }
        $cvv = generateCVV(3);

        $date = new DateTime();
        $date->modify("+5 years");
        $exp_date = $date->format("m/y");
        $user_id = $_GET["id"];

        $stmt = $conn->prepare("INSERT INTO public.cards_credit
                (card_number, credit_limit, total_spent, account_id, expiration_date, cvv)
                VALUES( :card_number, :credit_limit,:total_spent,:id, :expiration_date, :cvv);");
        $params = [
            ':card_number' => $n_account,
            ':credit_limit' => $limit_card,
            ':total_spent' => 0,
            ':cvv' => $cvv,
            ':expiration_date' => $exp_date,
            ':id' => $user_id,
        ];
        if ($stmt->execute($params)) {
            echo "<script>swal({ title: 'Successful Registration', text: 'User registered successfully', icon: 'success', button: 'Close' });</script>";
        } else {
            echo "<script>swal({ title: 'Registration Failed', text: 'There was an error registering the user.', icon: 'error', button: 'Close' });</script>";
        }
    }
    ?>


    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a class='sidebar-brand' href='index_view.php'>
                <img src="assets/images/banko logos-03.png" width="150px" />
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">

                    <img src="img/avatars/avatar.jpg" class="img-fluid rounded-circle mb-2" alt="" />
                    <div class="fw-bold">
                        <!-- <?php echo ($_SESSION['username']); ?> -->
                    </div>
                    <small>Admin</small>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='index_view.php'>
                            <i class="align-middle me-2" data-feather="home"></i> <span class="align-middle"><?= lang("Principal Index") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingaccounts.php'>
                            <i class="align-middle me-2 far fa-fw fa-dollar-sign"></i> <span class="align-middle"><?= lang("Add Bank Account") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingcards.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Add Debit/Credit Card") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='createuser_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle"><?= lang("Create User") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='listingtransferences_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Listing Transferences") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='listingpurchases_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Listing Purchases") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='listingpayments_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Listing Payments") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='listingcharges_view.php'>
                            <i class="align-middle me-2 fas fa-fw fa-donate"></i> <span class="align-middle"><?= lang("Listing Charges") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='listingcardspayment_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Listing Cards Payment") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='passrecord_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-users"></i> <span class="align-middle"><?= lang("Record of password changes") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='bank_applications.php'>
                            <i class="align-middle me-2 far fa-fw fa-users"></i> <span class="align-middle"><?= lang("Clients Requests") ?></span>
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
                                <a class="dropdown-item" href="creditcard_view.php?lang=en"><i class="align-middle me-1 fas fa-fw fa-user"></i> English</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="creditcard_view.php?lang=es"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
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
                            <?= lang("Credit Card") ?>
                        </h1>
                        <nav aria-label="breadcrumb">

                        </nav>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><?= lang("Always responsive") ?></h5>
                                <h6 class="card-subtitle text-muted"> </h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <?php
                                    $user_id = $_GET['id'];
                                    $conn = require("conexion.php");

                                    $stmt = $conn->prepare("SELECT u.* FROM users u join accounts a ON a.owner_id = u.id WHERE a.id = :id");
                                    $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $stmt = null;
                                    ?>
                                    <thead>
                                        <tr>
                                            <th style="width:10%;"><?= lang("Name") ?></th>
                                            <th style="width:15%"><?= lang("Username") ?></th>
                                            <th style="width:15%">Dui</th>
                                            <th class="d-none d-md-table-cell" style="width:25%">Email</th>
                                            <th class="d-none d-md-table-cell" style="width:15%"><?= lang("Number Accounts") ?></th>
                                        </tr>
                                    </thead>
                                    <form method="POST">
                                        <tbody>
                                            <tr>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $user_data["name"] ?>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $user_data["username"] ?>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $user_data["dui"] ?>
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <?php echo $user_data["email"] ?>
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <!-- <?php echo $user_data["n_account"] ?> -->
                                                </td>
                                            </tr>

                                        </tbody>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><?= lang("Credit Card") ?></h5>
                                    <h6 class="card-subtitle text-muted"></h6>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $user_id; ?>" method="POST">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="number"><?= lang("Create Credit Limit") ?></label>
                                                <input type="number" class="form-control" id="limit" name="limit" placeholder=<?= lang("Create Credit Limit") ?>>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                // Eliminar caracteres no permitidos
                const currentValue = e.target.value.replace(/\D/g, '');

                // Aplicar máscara al número de tarjeta
                let maskedValue = '';
                for (let i = 0; i < currentValue.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        maskedValue += '-';
                    }
                    maskedValue += currentValue[i];
                }

                // Limitar el número de tarjeta a 16 caracteres
                maskedValue = maskedValue.slice(0, 19);

                // Actualizar el valor del campo de entrada
                e.target.value = maskedValue;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const duiInput = document.getElementById('dui');

            duiInput.addEventListener('input', function(e) {
                // Eliminar caracteres no permitidos
                const currentValue = e.target.value.replace(/\D/g, '');

                // Aplicar máscara al DUI
                let maskedValue = '';
                for (let i = 0; i < currentValue.length; i++) {
                    if (i === 8) {
                        maskedValue += '-';
                    }
                    maskedValue += currentValue[i];
                }

                // Limitar el DUI a 10 caracteres
                maskedValue = maskedValue.slice(0, 10);

                // Actualizar el valor del campo de entrada
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


<!-- Mirrored from spark.bootlab.io/forms-layouts by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:29 GMT -->

</html>