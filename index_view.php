<?php
require 'index_lang.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = include_once "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from spark.bootlab.io/dashboard-default by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:27 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
    <meta name="author" content="Bootlab">
    <!-- <link href="/css/modern.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="package/dist/Sweetalert2.css">
    <script src="package/dist/Sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Administrator Dashboard</title>

    <!-- PICK ONE OF THE STYLES BELOW -->
    <!-- <link href="css/modern.css" rel="stylesheet"> -->
    <!-- <link href="css/classic.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->

    <!-- BEGIN SETTINGS -->
    <!-- You can remove this after picking a style -->
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
    <!-- <div>
        <div class="splash active">
            <div class="splash-icon"></div>
        </div> -->

    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a class='sidebar-brand' href='index_view.php'>
                <img src="img/brands/LogoBanko1.png" width="130px" />
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">

                    <img src="img/avatars/profile-use.png" class="img-fluid rounded-circle mb-2" alt="" />
                    <div class="fw-bold"><?php
                                            echo ($_SESSION['username']); ?></div>
                    <small>Admin</small>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='createuser_view.php'>
                            <i class="align-middle me-2" data-feather="users"></i> <span class="align-middle"><?= lang("Create New User"); ?></span>
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
                        <a class='sidebar-link' href='listingtransferences_view.php'>
                            <i class="align-middle me-2" data-feather="book"></i> <span class="align-middle"><?= lang("Listing Transferences") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='listingpurchases_view.php'>
                            <i class="align-middle me-2" data-feather="shopping-bag"></i> <span class="align-middle"><?= lang("Listing Purchases") ?></span>
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
                            <i class="align-middle me-2" data-feather="eye-off"></i> <span class="align-middle"><?= lang("Record of password changes") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='bank_applications.php'>
                            <i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle"><?= lang("Clients Requests") ?></span>
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
                                <a class="dropdown-item" href="index_view.php?lang=en"><i class="align-middle me-1 fas fa-fw fa-user"></i> English</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index_view.php?lang=es"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
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
                        <h1 class="header-title"><?= lang("Welcome Back") ?></h1>
                        <p class="header-subtitle"></p>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-xxl-7">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <div class="card-actions float-end">
                                        <a href="#" class="me-1">
                                            <i class="align-middle" data-feather="refresh-cw"></i>
                                        </a>
                                        <div class="d-inline-block dropdown show">
                                        </div>
                                    </div>
                                    <h5 class="card-title mb-0"><?= lang("Recent Movements") ?></h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <?php
                                        $stmt = $conn->prepare("
                                        select * from (
SELECT 
    SUBSTRING(date FROM 7) AS date_part, 
    COUNT(*) AS count
FROM 
    transfers 
GROUP BY 
    SUBSTRING(date FROM 7)
ORDER BY  
    SUBSTRING(date FROM 7)
LIMIT 15 
) as dates
order by 
SUBSTRING(dates.date_part FROM 7 FOR 4) asc,  -- Year part
    SUBSTRING(dates.date_part FROM 4 FOR 2) asc,  -- Month part
    SUBSTRING(dates.date_part FROM 1 FOR 2) asc   -- Day part 
;
                                        ");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        $test = array();

                                        $dataPoints = array();
                                        $i = 0;
                                        foreach ($result as $tr) {
                                            $count = $tr["count"];
                                            $date = $tr["date_part"];
                                            $test = array("y" => $count, "label" => $date);
                                            array_push($dataPoints, $test);
                                        }
                                        // print_r($dataPoints);
                                        ?>
                                        <script>
                                            window.onload = function() {
                                                var chart = new CanvasJS.Chart("chartContainer", {
                                                    animationEnabled: true,
                                                    title: {
                                                        text: "<?= lang("Transactions") ?>"
                                                    },
                                                    axisY: {
                                                        title: "<?= lang("Number of transactions") ?>",
                                                        includeZero: true,

                                                    },
                                                    data: [{
                                                        type: "bar",

                                                        indexLabel: "{y}",
                                                        indexLabelPlacement: "inside",
                                                        indexLabelFontWeight: "bolder",
                                                        indexLabelFontColor: "white",
                                                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                                    }]
                                                });
                                                chart.render();
                                            }
                                        </script>


                                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-xxl-5 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <?php

                                                        $stmt = $conn->prepare("SELECT COUNT(id) FROM accounts");
                                                        $stmt->execute();
                                                        $num_cards = $stmt->fetch(PDO::FETCH_COLUMN);
                                                        ?>
                                                        <h5 class="card-title"><?= lang("Active Accounts") ?></h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <div class="avatar-title rounded-circle bg-primary-dark">
                                                                <i class="align-middle" data-feather="credit-card"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="display-5 mt-1 mb-3"><?php echo "$num_cards" ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php
                                                    $stmt = $conn->prepare("SELECT COUNT(id) FROM users");
                                                    $stmt->execute();
                                                    $num_usuarios = $stmt->fetch(PDO::FETCH_COLUMN);
                                                    ?>
                                                    <div class="col mt-0">
                                                        <h5 class="card-title"><?= lang("Active Users") ?></h5>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <div class="avatar-title rounded-circle bg-primary-dark">
                                                                <i class="align-middle" data-feather="users"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="display-5 mt-1 mb-3"><?php echo $num_usuarios; ?>
                                                </h1>
                                                <div class="mb-0">
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <?php
                                                        $stmt = $conn->prepare("SELECT COUNT(id_transfer) FROM transfers");
                                                        $stmt->execute();
                                                        $num_transacciones = $stmt->fetch(PDO::FETCH_COLUMN);
                                                        ?>
                                                        <h5 class="card-title"><?= lang("Total Transactions") ?></h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <div class="avatar-title rounded-circle bg-primary-dark">
                                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="display-5 mt-1 mb-3"><?php echo $num_transacciones; ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <?php
                                                        $stmt = $conn->prepare("SELECT SUM(balance) AS total_dinero FROM accounts;");
                                                        $stmt->execute();
                                                        $total_cash = $stmt->fetch(PDO::FETCH_COLUMN);
                                                        ?>
                                                        <h5 class="card-title"><?= lang("Cash Consolidation") ?></h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <div class="avatar-title rounded-circle bg-primary-dark">
                                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="display-5 mt-1 mb-3"><?php echo $total_cash; ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <div class="card-actions float-end">
                                        <a href="#" class="me-1">
                                            <i class="align-middle" data-feather="refresh-cw"></i>
                                        </a>
                                        <div class="d-inline-block dropdown show">
                                        </div>
                                    </div>
                                    <?php
                                    $stmt1 = $conn->prepare("SELECT u.*, COUNT(a.id) as accounts FROM users u JOIN accounts a on a.owner_id = u.id GROUP BY u.id ORDER BY u.id ASC;");
                                    $stmt1->execute();
                                    $i = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                                    //print_r($i);
                                    ?>
                                    <h5 class="card-title mb-0"><?= lang("Users") ?></h5>
                                </div>
                                <table id="datatables-dashboard-projects" class="table table-striped my-0">
                                    <thead>
                                        <tr>
                                            <th><?= lang("Name") ?></th>
                                            <th class="d-none d-xl-table-cell"><?= lang("Username") ?></th>
                                            <th class="d-none d-xl-table-cell">Dui</th>
                                            <th><?= lang("Address") ?></th>
                                            <th class="d-none d-md-table-cell">Email</th>
                                            <th class="d-none d-md-table-cell"><?= lang("Accounts") ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($i as $data) { ?>
                                            <tr>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $data["name"] ?>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $data["username"] ?>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $data["dui"] ?>
                                                </td>
                                                <td><span class="badge bg-success">
                                                        <?php echo $data["address"] ?>
                                                    </span></td>
                                                <td class="d-none d-md-table-cell">
                                                    <?php echo $data["email"] ?>
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <?php echo $data["accounts"] ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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



<!-- Mirrored from spark.bootlab.io/dashboard-default by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:27 GMT -->

</html>