<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from spark.bootlab.io/forms-layouts by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:29 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
	<meta name="author" content="Bootlab">
    <link rel="stylesheet" href="package/dist/Sweetalert2.css">
    <script src="package/dist/Sweetalert2.min.js"></script>

	<title>Create User</title>

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
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120946860-7');
</script></head>

<body>
	<?php
	$conn = include_once("conexion.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$name = mysqli_real_escape_string($conn,$_POST["name"]);
		$lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
		$username =  mysqli_real_escape_string($conn, $_POST["username"]);
		$password = mysqli_real_escape_string($conn, $_POST["password"]);
		$address = mysqli_real_escape_string($conn, $_POST["address"]);
		$dui = mysqli_real_escape_string($conn, $_POST["dui"]);
		$email = mysqli_real_escape_string($conn, $_POST["email"]);
	
	
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
	
	
		$sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
		$result_check_email = $conn->query($sql_check_email);
		if ($result_check_email->num_rows > 0) {
			echo "<p><script>Swal.fire({
				title: 'Email already registered',
				text: 'This email is already associated with an account.',
				icon: 'error',
				button: 'Close',
				});</script></p>";
			exit; 
		}
	
	
		$sql_check_username = "SELECT * FROM usuarios WHERE username = '$username'";
		$result_check_username = $conn->query($sql_check_username);
		if ($result_check_username->num_rows > 0) {
			echo "<p><script>Swal.fire({
				title: 'Username already in use',
				text: 'This username is already in use.',
				icon: 'error',
				button: 'Close',
				});</script></p>";
			exit; 
		}
	
		
		$sql_check_dui = "SELECT * FROM usuarios WHERE dui = '$dui'";
		$result_check_dui = $conn->query($sql_check_dui);
		if ($result_check_dui->num_rows > 0) {
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
			});
		</script></p>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
	?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<div class="splash active">
		<div class="splash-icon"></div>
	</div>

	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<a class='sidebar-brand' href='index_view.php'>
				<svg>
					<use xlink:href="#ion-ios-pulse-strong"></use>
				</svg>
				Spark
			</a>
			<div class="sidebar-content">
				<div class="sidebar-user">
					<img src="img/avatars/avatar.jpg" class="img-fluid rounded-circle mb-2" alt="Linda Miller" />
					<div class="fw-bold">Linda Miller</div>
					<small>Front-end Developer</small>
				</div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
						</a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='index_view.php'>Principal Index</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href=''>Add Bank Account</a></li>
							<li class="sidebar-item"><a class='sidebar-link ' href='addingcards.php'>Add Credit/Debit Card</a></li>
						</ul>
					</li>
				

					<li class="sidebar-header">
						Elements
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-flask"></i> <span class="align-middle">User Interface</span>
						</a>
						<ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='ui-alerts.html'>Alerts</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-buttons.html'>Buttons</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-cards.html'>Cards</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-general.html'>General</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-grid.html'>Grid</a>
							</li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-modals.html'>Modals</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-offcanvas.html'>Offcanvas</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-placeholders.html'>Placeholders</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-notifications.html'>Notifications</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-tabs.html'>Tabs</a>
							</li>
							<li class="sidebar-item"><a class='sidebar-link' href='ui-typography.html'>Typography</a></li>
						</ul>
					</li>


					<li class="sidebar-item">
						<a class='sidebar-link' href='tables-bootstrap.html'>
							<i class="align-middle me-2 fas fa-fw fa-list"></i> <span class="align-middle">Tables</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#datatables" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-table"></i> <span class="align-middle">DataTables</span>
						</a>
						<ul id="datatables" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='tables-datatables-responsive.html'>Responsive Table</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='tables-datatables-buttons.html'>Table with Buttons</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='tables-datatables-column-search.html'>Column Search</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='tables-datatables-fixed-header.html'>Fixed Header</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='tables-datatables-multi.html'>Multi Selection</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='tables-datatables-ajax.html'>Ajax Sourced Data</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#icons" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-heart"></i> <span class="align-middle">Icons</span>
						</a>
						<ul id="icons" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='icons-feather.html'>Feather</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='icons-ion.html'>Ion
									Icons</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='icons-font-awesome.html'>Font Awesome</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a class='sidebar-link' href='calendar.html'>
							<i class="align-middle me-2 far fa-fw fa-calendar-alt"></i> <span class="align-middle">Calendar</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#maps" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-map-marker-alt"></i> <span class="align-middle">Maps</span>
						</a>
						<ul id="maps" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='maps-google.html'>Google Maps</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='maps-vector.html'>Vector Maps</a></li>
						</ul>
					</li>

					<li class="sidebar-header">
						Extras
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#documentation" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-book"></i> <span class="align-middle">Documentation</span>
						</a>
						<ul id="documentation" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='docs-getting-started.html'>Getting Started</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='docs-plugins.html'>Plugins</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='docs-changelog.html'>Changelog</a></li>
						</ul>
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
					<input class="form-control form-control-lite" type="text" placeholder="Search projects...">
		

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item dropdown active">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-envelope-open"></i>
							</a>
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
							<a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-bell"></i>
								<span class="indicator"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-danger fas fa-fw fa-bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-warning fas fa-fw fa-envelope-open"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">6h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-primary fas fa-fw fa-building"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.1</div>
												<div class="text-muted small mt-1">8h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-success fas fa-fw fa-bell-slash"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Anna accepted your request.</div>
												<div class="text-muted small mt-1">12h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-user"></i> View Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Contacts</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-chart-pie"></i> Analytics</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-cogs"></i> Settings</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<main class="content">
				<div class="container-fluid">

					<div class="header">
						<h1 class="header-title">
							CREATE USER
						</h1>
						<nav aria-label="breadcrumb">

						</nav>
					</div>
					<div class="row">
						

						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Create User</h5>
									<h6 class="card-subtitle text-muted"></h6>
								</div>
								<div class="card-body">
									<form>
										<div class="row">
											<div class="mb-3 col-md-6">
												<label for="name">Name</label>
												<input type="name" class="form-control" id="name" placeholder="Name">
											</div>
											<div class="mb-3 col-md-6">
												<label for="lastname">Lastname</label>
												<input type="lastname" class="form-control" id="lastname" placeholder="Lastname">
											</div>
										</div>
										<div class="row">
											<div class="mb-3 col-md-6">
												<label for="username">Username</label>
												<input type="username" class="form-control" id="username" placeholder="Username">
											</div>
											<div class="mb-3 col-md-6">
												<label for="password">Password</label>
												<input type="password" class="form-control" id="password" placeholder="Password">
											</div>
										</div>
										<div class="mb-3">
											<label for="address">Address</label>
											<input type="text" class="form-control" id="address" placeholder="1234 Main St">
										</div>
										<div class="mb-3">
											<label for="email">Email</label>
											<input type="text" class="form-control" id="email" placeholder="email@example.com">
										</div>
										<div class="mb-3">
											<label for="card_number">Card Number</label>
											<input type="text" class="form-control" id="card_number" placeholder="0000-0000-0000-0000">
										</div>
										<div class="row">
											<div class="mb-3 col-md-6">
												<label for="dui">Dui</label>
												<input type="text" class="form-control" id="dui">
											</div>
											<div class="mb-3 col-md-4">
												<label for="inputState">User type</label>
												<select id="inputState" class="form-control">
													<option selected>Administrator</option>
													<option>Client</option>
												</select>
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
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms of Service</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Contact</a>
								</li>
							</ul>
						</div>
						<div class="col-4 text-end">
							<p class="mb-0">
								&copy; 2024 PTC - <a class='text-muted' href='dashboard-default.html'>Banko</a>
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
	<script src="js/app.js"></script>
	</form>
</body>


<!-- Mirrored from spark.bootlab.io/forms-layouts by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:29 GMT -->
</html>