<?php
require 'index_lang.php';
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
    <link href="/css/modern.css" rel="stylesheet">
    <link rel="stylesheet" href="package/dist/Sweetalert2.css">
    <script src="package/dist/Sweetalert2.min.js"></script>

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
    <!-- <div class="splash active">
        <div class="splash-icon"></div>
    </div> -->

    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a class='sidebar-brand' href='index_view.php'>
                <img src="img/brands/LogoBanko1.png" width="130px" />
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">
                    <?php
                    $pgsql = include_once "conexion.php";                  
                    $stmt = $conn->prepare("SELECT username FROM usuarios");
                    $stmt->execute();
                    $nom_usuario = $stmt->fetch(PDO::FETCH_COLUMN);   
                    ?>
                    <img src="img/avatars/avatar.jpg" class="img-fluid rounded-circle mb-2" alt="Linda Miller" />
                    <div class="fw-bold"><?php echo "$nom_usuario"; ?></div>
                    <small>Administrator</small>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='createuser_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle"><?= lang("Create New User") ?></span>
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
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Listing Transferences") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='passrecord_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-users"></i> <span class="align-middle"><?= lang("Record of password changes") ?></span>
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

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown active">

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Michelle Bilodeau">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Michelle Bilodeau</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
                                                <div class="text-muted small mt-1">5m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Kathie Burton">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Kathie Burton</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="Alexander Groves">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Alexander Groves</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Daisy Seger">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Daisy Seger</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
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
                                <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-user"></i> <?= lang("View Profile") ?></a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-comments"></i> <?= lang("Contacts") ?></a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-chart-pie"></i> <?= lang("Analytics") ?></a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-cogs"></i><?= lang("Settings") ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" type="submit" name="submit" id="submit"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i><?= lang("Sign out") ?></a>
                                <?php
if(isset($_POST['submit'])){
echo "<p><script>swal.fire({
title: 'Sign Out',
text: 'Loging Out',
icon: 'warning',
button: 'Cerrar',
});</script></p>";
}
?>
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
                                        $stmt = $conn->prepare("SELECT transaction_date AS 'date',COUNT(transaction_date) AS 'count' FROM transactions GROUP BY transaction_date ORDER BY transaction_date ASC LIMIT 15");
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $test = array();

                                        $dataPoints = array();
                                        $i = 0;
                                        foreach ($datalist as $tr) {
                                            $count = $tr["count"];
                                            $date = $tr["date"];
                                            $test = array("y" => $count, "label" => $date);
                                            array_push($dataPoints, $test);
                                        }

                                        ?>
                                        <script>
                                            window.onload = function() {
                                                var chart = new CanvasJS.Chart("chartContainer", {
                                                    animationEnabled: true,
                                                    title: {
                                                        text: "<?=lang ("Transactions")?>"
                                                    },
                                                    axisY: {
                                                        title: "<?=lang ("Number of transactions")?>",
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
                                                        
                                                        $stmt = $conn->prepare("SELECT COUNT(card_number) FROM usuarios");
                                                        $stmt->execute();
                                                        $num_cards = $stmt->fetch(PDO::FETCH_COLUMN);
                                                        ?>
                                                        <h5 class="card-title"><?= lang("Active Cards") ?></h5>
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
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span><?= lang("Less sales than usual") ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php
                                                    $stmt = $conn->prepare("SELECT COUNT(id_user) FROM usuarios");
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
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.50% </span><?= lang("More visitors than usual") ?>
                                                   
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
                                                        $stmt = $conn->prepare("SELECT COUNT(id_transaction) FROM transactions");
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
                                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
                                                 <?= lang("More earnings than usual") ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <?php
                                                         $stmt = $conn->prepare("SELECT id_account, SUM(amount) AS total_dinero FROM b_accounts GROUP BY id_account");
                                                         $stmt->execute();
                                                         $total_cash = $stmt->fetch(PDO::FETCH_COLUMN);                                                     
                                                        ?>
                                                        <h5 class="card-title"><?= lang("Cash Consolidation")?></h5>
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
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
                                                    <?= lang("Less orders than usual") ?>
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
                                     $stmt = $conn->prepare("SELECT id_user, name, lastname, username, password, address, dui, card_number, email FROM usuarios");
                                     $stmt->execute();
                                     $i = $stmt->fetch(PDO::FETCH_ASSOC);
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
                                            <th class="d-none d-md-table-cell"><?= lang("Card Number")?></th>
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
                                                    <?php echo $data["card_number"] ?>
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
    <script src="js/app.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                            label: "Orders",
                            fill: true,
                            backgroundColor: window.theme.primary,
                            borderColor: window.theme.primary,
                            borderWidth: 2,
                            data: [3, 2, 3, 5, 6, 5, 4, 6, 9, 10, 8, 9]
                        },
                        {
                            label: "Sales ($)",
                            fill: true,
                            backgroundColor: "rgba(0, 0, 0, 0.05)",
                            borderColor: "rgba(0, 0, 0, 0.05)",
                            borderWidth: 2,
                            data: [5, 4, 10, 15, 16, 12, 10, 13, 20, 22, 18, 20]
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 5
                            },
                            display: true,
                            gridLines: {
                                color: "rgba(0,0,0,0)",
                                fontColor: "#fff"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: 'pie',
                data: {
                    labels: ["Chrome", "Firefox", "IE", "Other"],
                    datasets: [{
                        data: [4401, 4003, 1589],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger,
                            "#E8EAED"
                        ],
                        borderColor: "transparent"
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: 'bar',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "This year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: .75,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var map = new jsVectorMap({
                map: "world",
                selector: "#world_map",
                zoomButtons: true,
                selectedRegions: [
                    'US',
                    'SA',
                    'DE',
                    'FR',
                    'CN',
                    'AU',
                    'BR',
                    'IN',
                    'GB'
                ],
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    },
                    selected: {
                        fill: window.theme.primary,
                    }
                },
                zoomOnScroll: false
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
            setTimeout(function() {
                map.updateSize();
            }, 250);
        });
    </script>
    <script>
        $(function() {
            $('#datatables-dashboard-projects').DataTable({
                pageLength: 6,
                lengthChange: false,
                bFilter: false,
                autoWidth: false
            });
        });
    </script>
    <script>
        $(function() {
            $('#datetimepicker-dashboard').datetimepicker({
                inline: true,
                sideBySide: false,
                format: 'L'
            });
        });
    </script>

</body>


<!-- Mirrored from spark.bootlab.io/dashboard-default by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:27 GMT -->

</html>