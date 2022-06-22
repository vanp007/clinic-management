<?php 
session_start();
if (!(isset($_SESSION['receptionist']))) {
	header("Location:../receptionistlogin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patient's Dashboard</title>
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
					<?php
					include("sidenav.php");
					?>
				</div>

				<div class="col-md-10">
					<div class="container-fluid">
						<h5 class="my-3">Patient's Dashboard</h5>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3 my-2 bg-success" style="height: 150px;">
									<div class="col-md-12">
										<div class="row text-white">
											<div class="col-md-8">
												<h5 class="text-center my-4">My Profile</h5>
											</div>
											<div class="col-md-4">
												<a href="profile.php"><i class="fa fa-user-circle fa-4x my-4" style="color: white;"></i></a>
											</div>
										</div>
									</div>
								</div>


								<div class="col-md-3 my-2 bg-info mx-4" style="height: 150px;">
									<div class="col-md-12">
										<div class="row text-white">
											<div class="col-md-8">
												<h5 class="text-center my-4">Book Appointment</h5>
											</div>
											<div class="col-md-4">
												<a href="profile.php"><i class="fa fa-calendar fa-4x my-4" style="color: white;"></i></a>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-3 my-2 bg-warning" style="height: 150px;">
									<div class="col-md-12">
										<div class="row text-white">
											<div class="col-md-8">
												<h5 class="text-center my-4">Invoice</h5>
											</div>
											<div class="col-md-4">
												<a href="profile.php"><i class="fas fa-file-invoice-dollar fa-4x my-4" style="color: white;"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php
						if (isset($_POST['send'])) {
							$title = $_POST['title'];
							$message = $_POST['message'];


							if (empty($title)) {
								echo "<script>alert('Write a Title.')</script>";
							}else if (empty($message)) {
								echo "<script>alert('Write a Meassage')</script>";
							}else{

								$user = $_SESSION['patient'];

								$query = "INSERT INTO tblreport(title, message, username, date_send)VALUES('$title','$message','$user',NOW())";

								$result = mysqli_query($connect,$query);

								if ($result) {
									echo "<script>alert('Report Sent.')</script>";
								}else{
									"<script>alert('Report Fail to be Sent.')</script>";
								}
							}
						}


						?>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6 shadow my-2">
									<h5 class="text-primary my-3">Send a report</h5>
									<form method="POST" class="">
										<label>Title</label>
										<input type="text" name="title" class="form-control" autocomplete="off" placeholder="Enter Your Title">

										<label>Message</label>
										<input type="text" name="message" class="form-control" autocomplete="off" placeholder="Enter Your Message">
										<br>

										<input type="submit" name="send" value="Send" class="btn btn-success">

										<div class="col-md-3"><br></div>
									</form>
									
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