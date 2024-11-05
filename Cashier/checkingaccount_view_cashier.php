<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../funcs/funcs.php';
require '../lang/lang.php';
$conn = include_once "../conexion.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login_view.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin & dashboard template">
    <meta name="author" content="Bootlab">
    <link rel="stylesheet" href="../package/dist/sweetalert2.css">
    <script src="../package/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Adding Checking Accounts</title>
    <style>
        body {
            opacity: 0;
        }
    </style>
    <script src="../js/settings_cashier.js"></script>
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
        
        $user_id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
   
       if ($conn === false) {
           die("Error");
       }
   
       if ($user_id === null) {
           echo "<script>
                   Swal.fire({ 
                       title: 'Invalid Request', 
                       text: 'No user ID specified.', 
                       icon: 'error', 
                       button: 'Close' 
                   
               </script>";
       } else {
   
           $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
           $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
           $stmt->execute();
           $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
           $stmt = null;
   
           if ($user_data) {
               $nameParts = explode(' ', $user_data['name']);
               $firstName = $nameParts[0]; 
               $lastname = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : '';
   
               $username = htmlspecialchars(trim($user_data["username"]));
               $password = $user_data["pass"];
               $address = $user_data["address"];
               $dui = htmlspecialchars(trim($user_data["dui"]));
               $email = htmlspecialchars(trim($user_data["email"]));
   
               $sql = "INSERT INTO user_requests (name, lastname, username, password, address, dui, email, status, account_type, request_type, user_type) VALUES (:name, :lastname, :username, :password, :address, :dui, :email, :status, :account_type, :request_type, :user_type)";
               $stmt = $conn->prepare($sql);
               $params = [
                   ':name' => $firstName,
                   ':lastname' => $lastname,
                   ':username' => $username,
                   ':password' => $password,
                   ':address' => $address,
                   ':dui' => $dui,
                   ':email' => $email,
                   ':status' => "waiting",
                   ':account_type' => "checking",
                   ':request_type' => "account",
                   ':user_type' => 3
               ];
   
               try {
                   if ($stmt->execute($params)) {
                       echo "<script>
                           Swal.fire({ 
                               title: 'Successful Request', 
                               text: 'User bank account request sent.', 
                               icon: 'success', 
                               button: 'Close' 
                           }).then(function() {
                               window.location = 'addingaccounts_cashier.php';
                           });
                       </script>";
                   } else {
                       echo "<script>
                           Swal.fire({ 
                               title: 'Failed Request', 
                               text: 'There was an error sending the request.', 
                               icon: 'error', 
                               button: 'Close' 
                           }).then(function() {
                               window.location = 'addingaccounts_cashier.php';
                           });
                       </script>";
                   }
               } catch (PDOException $e) {
                   echo 'Error: ' . $e->getMessage(); 
               }
           } else {
               echo "<script>
                   Swal.fire({ 
                       title: 'User Not Found', 
                       text: 'The specified user could not be found.', 
                       icon: 'warning', 
                       button: 'Close' 
                   }).then(function() {
                       window.location = 'addingaccounts_cashier.php';
                   });
               </script>";
           }
       }
   }
?>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a class='sidebar-brand' href='index_view_cashier.php'>
                <img src="../assets/images/banko logos-03.png" width="130px" />
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">
                    <img src="../img/avatars/profile-use.png" class="img-fluid rounded-circle mb-2" alt="" />
                    <div class="fw-bold"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
                    <small>Cashier</small>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">Main</li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='index_view_cashier.php'>
                            <i class="align-middle me-2" data-feather="home"></i> <span
                                class="align-middle"><?= lang("Principal Index") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='createuser_view_cashier.php'>
                            <i class="align-middle me-2 far fa-fw fa-user"></i> <span
                                class="align-middle"><?= lang("Create New User"); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='edit_delete_view_cashier.php'>
                            <i class="align-middle me-2" data-feather="users"></i> <span
                                class="align-middle"><?= lang("Edit/Delete Users"); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingaccounts_cashier.php'>
                            <i class="align-middle me-2 far fa-fw fa-dollar-sign"></i> <span
                                class="align-middle"><?= lang("Add Bank Account") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingcards_cashier.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span
                                class="align-middle"><?= lang("Add Debit/Credit Card") ?></span>
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
                            <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
                                data-bs-toggle="dropdown">
                                <i class="align-middle fas fa-language"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="index_view_cashier.php?lang=en"><i
                                        class="align-middle me-1 fas fa-fw fa-user"></i> English</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index_view_cashier.php?lang=es"><i
                                        class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index_view_cashier.php?lang=de"><i
                                        class="align-middle me-1 fas fa-fw fa-comments"></i> Deutsch</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
                                data-bs-toggle="dropdown">
                                <i class="align-middle fas fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../logout.php"><i
                                        class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i><?= lang("Sign out") ?></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content">
                <div class="container-fluid">
                    <div class="header">
                        <h1 class="header-title"><?= lang("Creating Checking Account") ?></h1>
                        <nav aria-label="breadcrumb"></nav>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><?= lang("Always responsive") ?></h5>
                                <h6 class="card-subtitle text-muted"> </h6>
                            </div>
                                <div class="table-container mb-4">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <?php
                                            $user_id = $_GET['id'];

                                            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
                                            $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
                                            $stmt->execute();
                                            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $stmt = null;
                                            ?>
                                            <thead>
                                                <tr>
                                                    <th style="width:10%;"><?= lang("Name") ?></th>
                                                    <th style="width:15%;"><?= lang("Username") ?></th>
                                                    <th style="width:15%;">DUI</th>
                                                    <th class="d-none d-md-table-cell" style="width:20%;">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="d-none d-xl-table-cell">
                                                        <?= htmlspecialchars($user_data["name"]) ?>
                                                    </td>
                                                    <td class="d-none d-xl-table-cell">
                                                        <?= htmlspecialchars($user_data["username"]) ?>
                                                    </td>
                                                    <td class="d-none d-xl-table-cell">
                                                        <?= htmlspecialchars(decryptPayload($user_data['dui'])) ?>
                                                    </td>
                                                    <td class="d-none d-md-table-cell">
                                                        <?= htmlspecialchars(decryptPayload($user_data['email'])) ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form action="checkingaccount_view_cashier.php" method="post">
                                        <div class="table-container mb-4">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:10%;">ID</th>
                                                            <th style="width:15%;"><?= lang("Account Number") ?></th>
                                                            <th class="d-none d-md-table-cell" style="width:20%;"></th>
                                                            <th class="d-none d-md-table-cell" style="width:20%;"></th>
                                                            <th class="table-action" style="width:20%;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="d-none d-xl-table-cell">
                                                                <?= htmlspecialchars($user_data["id"]) ?>
                                                            </td>
                                                            <td class="d-none d-xl-table-cell">
                                                                <?= lang("Number will be generated by the administrator") ?>
                                                            </td>
                                                            <td class="d-none d-md-table-cell"></td>
                                                            <td class="d-none d-md-table-cell"></td>
                                                            <td class="table-action">
                                                                <button
                                                                    onclick="location.href='addingaccounts_cashier.php'"
                                                                    class="btn btn-danger"><?= lang("Return") ?></button>
                                                            </td>
                                                            <td class="table-action">
                                                                <input type="hidden" name="id" value="<?= $user_id ?>">
                                                                <button type="submit" class="btn btn-success"><?= lang("Request Account") ?></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row text-muted">
                <div class="col-8 text-start"></div>
                <div class="col-4 text-end">
                    <p class="mb-0">&copy; 2024 - <a class='text-muted' href='Cashier/index_view_cashier.php'>Banko</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <svg width="0" height="0" style="position:absolute">
        <defs>
            <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
                <path
                    d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
                </path>
            </symbol>
        </defs>
    </svg>
    <script src="../js/app.js"></script>
</body>
</html>