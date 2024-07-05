<?php
require 'addingaccounts_lang.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = include_once "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from spark.bootlab.io/pages-blank by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:27 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
	<meta name="author" content="Bootlab">

	<title>Listing Cards Payments</title>

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
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120946860-7');
</script></head>

<body>
	<!-- <div class="splash active">
		<div class="splash-icon"></div>
	</div> -->

	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<a class='sidebar-brand' href='index_view.php'>
				<img src="assets/images/banko logos-10.png" width="150px" />
			</a>
			<div class="sidebar-content">
           
				<div class="sidebar-user">
					<img src="img/avatars/profile-use.png" class="img-fluid rounded-circle mb-2" alt="" />
					<div class="fw-bold"><?php echo $_SESSION['username'];?></div>
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
                            <i class="align-middle me-2 far fa-fw fa-user"></i> <span
                                class="align-middle"><?= lang("Create New User"); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingaccounts.php'>
                            <i class="align-middle me-2 far fa-fw fa-dollar-sign"></i> <span
                                class="align-middle"><?= lang("Add Bank Account") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingcards.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span
                                class="align-middle"><?= lang("Add Debit/Credit Card") ?></span>
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
                        <a class='sidebar-link' href='passrecord_view.php'>
                            <i class="align-middle me-2" data-feather="eye-off"></i> <span class="align-middle"><?= lang("Record of password changes") ?></span>
                        </a>
                    </li>
					<li class="sidebar-item"> 
                        <a class='sidebar-link' href='bank_applications.php'>
                            <i class="align-middle me-2 far fa-fw fa-user"></i> <span
                                class="align-middle"><?= lang("Clients Requests") ?></span>
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
                                <a class="dropdown-item" href="listingcharges_view.php?lang=en"><i class="align-middle me-1 fas fa-fw fa-user"></i> English</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="listingcharges_view.php?lang=es"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
                            </div>
                        </li>

						</li>
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown"> 
                                <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i><?= lang("Sign out") ?></a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<main class="content">
				<div class="container-fluid">

					<div class="header">
						<h1 class="header-title">
                        <?= lang("Listing Cards Payments") ?>
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">

							</ol>
						</nav>
					</div>
					<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title"></h5>
									<h6 class="card-subtitle text-muted"> </h6>
								</div>
								<div class="table-responsive">
								<table class="table table-striped">

								<?php      
								$stmt = $conn->prepare("SELECT * FROM cards_payment");
								$stmt->execute();
								$i = $stmt->fetchAll(PDO::FETCH_ASSOC);                              
                                    ?>
									<thead>
										<tr>
											<th style="width:10%;"><?= lang("Id") ?></th>
											<th style="width:15%"><?= lang("Amount") ?></th>
											<th style="width:15%"><?= lang("Sender Account") ?></th>
											<th class="d-none d-md-table-cell" style="width:10%"><?= lang("Card Number") ?></th>
											<th class="d-none d-md-table-cell" style="width:10%"><?= lang("Date") ?></th>
											<th class="d-none d-md-table-cell" style="width:10%"><?= lang("Days left") ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        foreach ($i as $data) { ?>
                                            <tr>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $data["id"] ?>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $data["amount"] ?>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <?php echo $data["sender_acn"] ?>
                                                </td>
												<td class="d-none d-xl-table-cell">
                                                    <?php echo $data["card_number"] ?>
                                                </td>
												<td class="d-none d-xl-table-cell">
                                                    <?php echo $data["date"] ?>
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <?php echo $data["days_left"] ?>
                                                </td>
												<td class="table-action">
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
								&copy; 2024 - <a class='text-muted' href='index_view.php'>Banko</a>
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

</body>
<!-- Mirrored from spark.bootlab.io/pages-blank by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:27 GMT -->
</html>