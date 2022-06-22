<?php 
session_start();
if (!(isset($_SESSION['admin']))) {
	header("Location:../adminlogin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
</head>
<body>

	<?php
	include("../include/header.php");

	include("../include/connection.php");
	?>

	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2" style="margin-left: -30px;">
					<!--Sidenav-->
					<div class="list-group bg-primary" style="height: 92vh;">
					 
						<?php
						include ("sidenav.php");

						?>
					</div>

					<!-- endsSidenav-->
				</div>
				<div class="col-md-10">
					<h4 class="my-2">Admin Dashboard</h4>
					<div class="col-md-12 my-1">
						<div class="row">
							<div class="col-md-3 bg-success mx-3" style="height: 90px">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<?php

											$ad = mysqli_query($connect,"SELECT * FROM tbladmin");
											$number = mysqli_num_rows($ad);
											?>
											<h5 class="my-2 text-white text-center" style="font-size: 30px;"></h5>
											<h5 class="text-white text-center"><?php echo $number; ?></h5>
											<h5 class="text-white text-center">Total Admin</h5>
										</div>
										<div class="col-md-4">
											<a href="addmin.php"><i class="fa fa-users-cog fa-3x my-4" style="color: white;"></i></a>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>
							</div>

							<div class="col-md-3 bg-primary mx-3" style="height: 90px">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<?php

											$query = mysqli_query($connect, "SELECT * FROM tbldoctor WHERE role = 1");
											$num3 = mysqli_num_rows($query);
											?>
											<h5 class="my-2 text-white text-center" style="font-size: 30px;"></h5>
											<h5 class="text-white text-center"><?php echo $num3; ?></h5>
											<h5 class="text-white text-center">Total Doctors</h5>
										</div>
										<div class="col-md-4">
											<a href="doctor.php"><i class="fa fa fa-users fa-3x my-4" style="color: white;"></i></a>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>
								
							</div>

							<div class="col-md-3 bg-info mx-3" style="height: 90px">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<?php

											$query3 = mysqli_query($connect, "SELECT * FROM tblpatient");
											$num4 = mysqli_num_rows($query3);
											?>
											<h5 class="my-2 text-white text-center" style="font-size: 30px;"></h5>
											<h5 class="text-white text-center"><?php echo $num4; ?></h5>
											<h5 class="text-white text-center">Total Patients</h5>
										</div>
										<div class="col-md-4">
											<a href=""><i class="fa fa fa-bed fa-3x my-4" style="color: white;"></i></a>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>
							</div>

							<div class="col-md-3 bg-danger mx-3 my-2" style="height: 90px">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<h5 class="my-2 text-white text-center" style="font-size: 30px;"></h5>
											<h5 class="text-white text-center">0</h5>
											<h5 class="text-white text-center">Total Report</h5>
										</div>
										<div class="col-md-4">
											<a href=""><i class="fa fa-flag fa-3x my-4" style="color: white;"></i></a>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>
							</div>

							<div class="col-md-3 bg-warning mx-3 my-2" style="height: 90px">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<h5 class="my-2 text-white text-center" style="font-size: 30px;"></h5>
											<h5 class="text-white text-center">0</h5>
											<h5 class="text-white text-center">Total Income</h5>
										</div>
										<div class="col-md-4">
											<a href=""><i class="fa fa-file fa-3x my-4" style="color: white;"></i></a>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>
							</div>

							

							<div class="col-md-3 bg-warning mx-3 my-2" style="height: 90px">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-8">
											<?php

											$query = mysqli_query($connect, "SELECT * FROM tbldoctor WHERE role = 2");
											$receptionist = mysqli_num_rows($query);
											?>
											<h5 class="my-2 text-white text-center" style="font-size: 30px;"></h5>
											<h5 class="text-white text-center"><?php echo $receptionist; ?></h5>
											<h5 class="text-white text-center">Total Receptionist</h5>
										</div>
										<div class="col-md-4">
											<a href="receptionist.php"><i class="fa fa fa-users fa-3x my-4" style="color: white;"></i></a>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>
							</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</body>
</html>