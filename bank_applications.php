<?php
require 'addingaccounts_lang.php';
$conn = include_once "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from spark.bootlab.io/pages-blank by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:27 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/login.css">
	<link rel="stylesheet" href="package/dist/sweetalert2.css">
	<script src="package/dist/sweetalert2.min.js"></script>

	<title>Adding Bank Accounts</title>

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
					<img src="img/avatars/profile-use.png" class="img-fluid rounded-circle mb-2" alt="Linda Miller" />
					<div class="fw-bold"><?php echo ($_SESSION["username"]); ?></div>
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
				</ul>


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
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-language"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="bank_applications.php?lang=en"><i class="align-middle me-1 fas fa-fw fa-user"></i> English</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="bank_applications.php?lang=es"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
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
							<?= lang("Adding Bank Accounts") ?>
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">

							</ol>
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



									if ($_SERVER["REQUEST_METHOD"] == "POST") {

										if (isset($_POST['accept'])) {
											$request_id = $_POST['request_id'];

											try {

												$stmt_select_request = $conn->prepare("SELECT * FROM user_requests WHERE id = :id");
												$stmt_select_request->bindParam(':id', $request_id);
												$stmt_select_request->execute();
												$request_data = $stmt_select_request->fetch(PDO::FETCH_ASSOC);


												$stmt_insert_user = $conn->prepare("INSERT INTO users (dui, pass, email, name, address, username, rol, state) 
                                                VALUES (:dui, :pass, :email, :name, :address, :username, '3', '1')");
												$stmt_insert_user->bindParam(':dui', $request_data['dui']);
												$stmt_insert_user->bindParam(':pass', $request_data['password']);
												$stmt_insert_user->bindParam(':email', $request_data['email']);
												$stmt_insert_user->bindParam(':name', $request_data['name']);
												$stmt_insert_user->bindParam(':address', $request_data['address']);
												$stmt_insert_user->bindParam(':username', $request_data['username']);

												$stmt_insert_user->execute();

												$stmt_delete_request = $conn->prepare("UPDATE user_requests SET status = 'completed' WHERE id = :id");
												$stmt_delete_request->bindParam(':id', $request_id);
												$stmt_delete_request->execute();

												echo "<script>Swal.fire({ title: 'Success', text: 'The application has been accepted', icon: 'success', button: 'Close' });</script>";
											} catch (PDOException $e) {
												echo "<script>
			Swal.fire({
				title: 'Accept Error',
				text: 'The application has present an error:" . $e . "',
				icon: 'error',
				button: 'Close'
			}).then(function() {
				window.location = 'bank_applications.php';
			});
		  </script>";
											}
										} elseif (isset($_POST['reject'])) {
											$request_id = $_POST['request_id'];

											try {

												$stmt_delete_request = $conn->prepare("UPDATE user_requests SET status = 'rejected' WHERE id = :id");
												$stmt_delete_request->bindParam(':id', $request_id);
												$stmt_delete_request->execute();

												echo "<script>
			Swal.fire({
				title: 'Reject Success',
				text: 'The request has been successfully rejected',
				icon: 'success',
				button: 'Close'
			}).then(function() {
				window.location = 'bank_applications.php';
			});
		  </script>";
											} catch (PDOException $e) {
												echo "<script>
			Swal.fire({
				title: 'Reject Error',
				text: 'The rejection of this request presents an error ".$e."',
				icon: 'error',
				button: 'Close'
			}).then(function() {
				window.location = 'bank_applications.php';
			});
		  </script>";
											}
										}
									}

									// Seleccionar todas las solicitudes de la tabla user_requests
									$stmt_select_requests = $conn->prepare("SELECT * FROM user_requests WHERE status = '';");
									$stmt_select_requests->execute();
									$requests = $stmt_select_requests->fetchAll(PDO::FETCH_ASSOC);
									?>


									<tr>
										<th><?= lang("Name") ?></th>
										<th><?= lang("Username") ?></th>
										<th>Dui</th>
										<th>Email</th>
										<th><?= lang("Address") ?></th>
										<th><?= lang("Actions") ?></th>
									</tr>
									</thead>
									<tbody>
										<?php foreach ($requests as $request) : ?>
											<tr>
												<td><?= $request['name'] ?></td>
												<td><?= $request['username'] ?></td>
												<td><?= $request['dui'] ?></td>
												<td><?= $request['email'] ?></td>
												<td><?= $request['address'] ?></td>
												<td>
													<form method="post">
														<input type="hidden" name="request_id" value="<?= $request['id'] ?>">
														<input type="hidden" name="request_pass" value="<?= $request['pass'] ?>">
														<button type="submit" class="btn btn-success" name="accept"><?= lang("Accept") ?></button>
														<button type="submit" class="btn btn-danger" name="reject"><?= lang("Reject") ?></button>
													</form>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>