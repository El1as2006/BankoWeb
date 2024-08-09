<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
ini_set('memory_limit', '512M');
require_once "../lang/lang.php";
require_once "../funcs/funcs.php";
$conn = include_once("../conexion.php");

// if (!isset($_SESSION['logged_admin']) || $_SESSION['logged_admin'] !== true) {
//     header('Location: ../login_view.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
	<meta name="author" content="Bootlab">
    <link rel="stylesheet" href="../package/dist/sweetalert2.css">
    <script src="../package/dist/sweetalert2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<title>Edit User</title>

	<style>
		body {
			opacity: 0;
		}
	</style>
	<script src="../js/settings_admin.js"></script>
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

    if (!$conn) {
        echo "<script>
                Swal.fire({ 
                    title: 'Database Connection Failed', 
                    text: 'There was an error connecting to the database.', 
                    icon: 'error', 
                    button: 'Close' 
                }).then(function() {
                    window.location = 'edituser_view_cashier.php';
                });
              </script>";
        exit;
    }

    $name = htmlspecialchars(trim($_POST["name"]));
    $lastname = htmlspecialchars(trim($_POST["lastname"]));
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = htmlspecialchars(trim($_POST["pass"]));
    $address = htmlspecialchars(trim($_POST["address"]));
    $dui = htmlspecialchars(trim($_POST["dui"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $user_type = (int)$_POST["user_type"];
    $stat = 1; 

    $dui = str_replace('-', '', $dui);

    if (!preg_match("/^[a-zA-Z ]*$/", $name) || !preg_match("/^[a-zA-Z ]*$/", $lastname)) {
        echo "<script>
                Swal.fire({ 
                    title: 'Invalid Name or Lastname', 
                    text: 'Please enter a valid name and lastname (only letters allowed).', 
                    icon: 'error', 
                    button: 'Close' 
                }).then(function() {
                    window.location = 'edituser_view_cashier.php';
                });
              </script>";
        exit;
    }
    
    if (!preg_match("/^[0-9-]*$/", $dui)) {
        echo "<script>
                Swal.fire({ 
                    title: 'Invalid DUI', 
                    text: 'Please enter a valid DUI (only numbers and hyphen allowed).', 
                    icon: 'error', 
                    button: 'Close' 
                }).then(function() {
                    window.location = 'edituser_view_cashier.php';
                });
              </script>";
        exit;
    }
    
    if (preg_match('/[<>]/', $address)) {
        echo "<script>
                Swal.fire({
                    title: 'Invalid Address',
                    text: 'Please enter a valid address without <> characters.',
                    icon: 'error',
                    button: 'Close'
                }).then(function() {
                    window.location = 'createuser_view_cashier.php';
                });
              </script>";
        exit;
    }

    $sql = "SELECT * FROM users WHERE email = :email OR username = :username OR dui = :dui";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':email' => $email, ':username' => $username, ':dui' => $dui]);
    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $encrypted_address = encryptPayload($address);
    $encrypted_dui = encryptPayload($dui); 
    $encrypted_email = encryptPayload($email);
    $request = "edit";

    $fullName = $name . " " . $lastname;

    $sql = "INSERT INTO user_requests (name, lastname, username, password, address, dui, email, status, request_type, user_type) 
        VALUES (:name, :lastname, :username, :password, :address, :dui, :email, :status, :request_type, :user_type)";

    $stmt = $conn->prepare($sql);
    $params = [
        ':name' => $fullName,
        ':lastname' => $lastname,
        ':username' => $username,
        ':password' => $hashed_password, 
        ':address' => $encrypted_address,
        ':dui' => $encrypted_dui,
        ':email' => $encrypted_email,
        ':status' => "waiting",
        ':request_type' => $request,
        ':user_type' => $user_type
    ];

    try {
        if ($stmt->execute($params)) {
            echo "<script>
                Swal.fire({ 
                    title: 'Successful Request', 
                    text: 'Edition requested successfully.', 
                    icon: 'success', 
                    button: 'Close' 
                }).then(function() {
                    window.location = 'edit_delete_view_cashier.php';
                });
              </script>";
        } else {
            echo "<script>
                Swal.fire({ 
                    title: 'Failed Request', 
                    text: 'There was an error requesting the edition.', 
                    icon: 'error', 
                    button: 'Close' 
                }).then(function() {
                    window.location = 'edit_delete_view_cashier.php';
                });
              </script>";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage(); 
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
					<div class="fw-bold"><?php
					echo $_SESSION['username']; ?></div>
					<small>Admin</small>
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
									<a class="dropdown-item" href="edituser_view.php?lang=en"><i
											class="align-middle me-1 fas fa-fw fa-comments"></i> English</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="edituser_view.php?lang=es"><i
											class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
                                            <div class="dropdown-divider"></div>
									<a class="dropdown-item" href="edituser_view.php?lang=de"><i
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
                        <h1 class="header-title">
                            <?= lang("Edit Users") ?>
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

										$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
										$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
										$stmt->execute();
										$user_data = $stmt->fetch(PDO::FETCH_ASSOC);
										$stmt = null;

										?>
										<div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><?= lang("Edit User") ?></h5>
                                    <h6 class="card-subtitle text-muted"></h6>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name"><?= lang("Name") ?></label>
                                                <?php
                                                $nameParts = explode(' ', $user_data['name']);
                                                $firstName = $nameParts[0]; 
                                                ?>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="<?= lang("Name") ?>"
                                                    value="<?= htmlspecialchars($firstName) ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="name"><?= lang("Lastname") ?></label>
                                                <?php
                                                $nameParts = explode(' ', $user_data['name']);
                                                $lastName = $nameParts[1]; 
                                                ?>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="<?= lang("Lastname") ?>"
                                                    value="<?= htmlspecialchars($lastName) ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="username"><?= lang("Username") ?></label>
                                                <input type="username" class="form-control" id="username" name="username" placeholder=<?= lang("Username") ?> value="<?= htmlspecialchars($user_data['username'])?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="pass"><?= lang("Password") ?></label>
                                                <input type="password" class="form-control" id="pass" name="pass" placeholder=<?= lang("Password") ?>>
                                            </div>
                                        </div>
                                        <div class="mb-3">
											<?php 
											$decrypted_address = decryptPayload($user_data["address"])
											?>
                                            <label for="address"><?= lang("Address") ?></label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder=<?= lang("Address") ?> value="<?=htmlspecialchars($decrypted_address)?>">
                                        </div>
                                        <div class="mb-3">
											<?php 
											$decrypted_email = decryptPayload($user_data["email"])
											?>
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="email@gmail.com" value="<?=htmlspecialchars($decrypted_email)?>">
                                        </div>
                                        <div class="row">
											<?php 
											$decrypted_dui = decryptPayload($user_data["dui"])
											?>
                                            <div class="mb-3 col-md-6">
                                                <label for="dui">DUI</label>
                                                <input type="text" class="form-control" id="dui" name="dui" placeholder="00000000-0"value="<?=htmlspecialchars($decrypted_dui)?>">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label for="inputState"><?= lang("User type") ?></label>
                                                <select id="inputState" name="user_type" class="form-control">
                                             <option value="1"><?= lang("Administrator") ?></option>
                                             <option value="2"><?= lang("Cashier") ?></option>
                                             <option value="3"><?= lang("Client") ?></option>
                                               </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Send Request</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
									&copy; 2024 - <a class='text-muted' href='index_view_cashier.php'>Banko</a>
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
					<path
						d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
					</path>
				</symbol>
			</defs>
		</svg>
		<script src="../js/app.js"></script>

</body>
</html>