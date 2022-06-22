
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>header</title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="/hms/assets/css/bootstrap5.css">
	<link rel="stylesheet" type="text/css" href="/hms/assets/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="/hms/assets/css/animate.css">
	<script src="/hms/assets/js/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
	<script src="/hms/assets/js/jquery.min.js"></script>

<script type="text/javascript" src="/hms/assets/sweetAlert2/dist/sweetalert2.all.min.js"></script>

		<link rel="shortcut icon" href="/hms/img/logo1.png">
</head>
<body>
	<nav class="navbar navbar-expand-lg navabar-info bg-success">
		<h3 class="text-white px-1"><span class="text-white">Clinic </span>Management System | </h3>
		
		<div class="mr-auto">
			
		</div>
		<ul class="navbar-nav">
			<?php 
			if (isset($_SESSION['admin'])) {
				$user = $_SESSION['admin'];
				echo '
			<li class="nav-item"><a href="" class="nav-link text-white">'.$user.'</a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>';
			}else if(isset($_SESSION['doctor'])){
				$user = $_SESSION['doctor'];

				echo '
			<li class="nav-item"><a href="" class="nav-link text-white">'.$user.'</a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>';

			}else if(isset($_SESSION['receptionist'])){
				$user = $_SESSION['receptionist'];

				echo '
			<li class="nav-item"><a href="" class="nav-link text-white">'.$user.'</a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>';

			}
			else{
				echo '<li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
				<li class="nav-item"><a href="adminlogin.php" class="nav-link text-white">Admin</a></li>
			<li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white">Doctor</a></li>
			<li class="nav-item"><a href="receptionistlogin.php" class="nav-link text-white">Receptionist</a></li>';
			}

			?>
		</ul>
	</nav>
<!-- 
	<script type="../assets/js/wow.min.js"></script>
	<script type="../assets/js/main.js"></script> -->
</body>
</html>