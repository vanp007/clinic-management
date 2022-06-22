<?php
session_start();
if(!isset($_SESSION['doctor'])){
	header("location:../doctorlogin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Doctor's Profile</title>
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
						<div class="col-md-12">
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-5">
									<?php
									$doc = $_SESSION['doctor'];
									$query = "SELECT * FROM tbldoctor WHERE username = '$doc'";

									$result = mysqli_query($connect,$query);
									$row = mysqli_fetch_array($result);

									if (isset($_POST['upload'])) {
										$img = $_FILES['img']['name'];

										if (empty($img)) {
											
										}else{
											$query = "UPDATE tbldoctor SET profile = '$img' WHERE username = '$doc'";
										$result = mysqli_query($connect,$query);

										if ($result) {
											move_uploaded_file($_FILES['img']['tmp_name'],"img/$img");
										}
										}
									}
									?>

									<form method="POST" enctype="multipart/form-data">
									<?php
									echo "<img src='img/".$row['profile']."' style='height: 170px; width: 180px;' class='col-md-12 my-3'>";
									?>
									<input type="file" name="img" class="form-control my-1">
									<input type="submit" name="upload" class="btn btn-success" value="Update Profile">
								</form>

								<div class="my-3">
									<table class="table table-bordered">
										<tr>
											<th colspan="2" class="text-center">Details</th>
										</tr>
										<tr>
											<td>Firstname</td>
											<td><?php echo $row['firstname']; ?></td>
										</tr>

										<tr>
											<td>Surname</td>
											<td><?php echo $row['surname']; ?></td>
										</tr>

										<tr>
											<td>Username</td>
											<td><?php echo $row['username']; ?></td>
										</tr>

										<tr>
											<td>Gender</td>
											<td><?php echo $row['gender']; ?></td>
										</tr>

										<tr>
											<td>Email</td>
											<td><?php echo $row['email']; ?></td>
										</tr>

										<tr>
											<td>Phone</td>
											<td><?php echo $row['phone']; ?></td>
										</tr>
										
									</table>
								</div>
								</div>
								<div class="col-md-6">
									<h5>Change Username</h5>
									<?php
									if (isset($_POST['change_name'])) {
										$uname = $_POST['uname'];

										if (empty($uname)) {
											
										}else{
											$query = "UPDATE tbldoctor SET username = '$uname' WHERE username = '$doc'";

										$result = mysqli_query($connect,$query);

										if ($result) {

											$_SESSION['doctor'] = $uname;
											echo
											'<script>alert("surname changed successfully")</script>';
											
										}
										}
									}


									?>
									<form method="POST">
										<label>Change Username</label>
										<input type="text" name="uname" placeholder="Enter Username" class="form-control" autocomplete="off"><br>
										<input type="submit" name="change_name" value="Change Username" class="btn btn-success">
									</form>
									<br><br>

									<h5>Change Password</h5>
									<?php
									if (isset($_POST['submit'])) {
										$old_pass = $_POST['old_pass'];
										$new_pass = $_POST['new_pass'];
										$confirm_pass = $_POST['confirm_pass'];

										$old_password = "SELECT * FROM tbldoctor WHERE username = '$doc'";

										$result = mysqli_query($connect,$old_password);
										$row = mysqli_fetch_array($result);


										if($old_pass != $row['password']){
											echo'<script>alert("wrong old password")</script>';
										}else if(empty($new_pass)){
											echo'<script>alert("password cannot be empty")</script>';
										}else if($confirm_pass != $new_pass){
											echo'<script>alert("new password and confirm password does not match")</script>';
										}else{
											$query = "UPDATE tbldoctor SET password = '$new_pass' WHERE username = '$doc'";
											$rs = mysqli_query($connect,$query);
											if($rs){
												echo
												'<script>alert("password changed successfully")
													window.location("profile.php");
												</script>';
											}
										}
									}

									?>
									<form method="POST">
										<label>Old Password</label>
										<input type="password" name="old_pass" placeholder="Enter Old Password" class="form-control">

										<label>New Password</label>
										<input type="password" name="new_pass" placeholder="Enter New Password" class="form-control">

										<label>Confirm Password</label>
										<input type="password" name="confirm_pass" placeholder="Enter Confirm Password" class="form-control">
										<br>
										<input type="submit" name="submit" value="Change Password" class="btn btn-success">
									</form>
								</div>
								<div class="col-md-1 my-3">
									<a href="profile.php" class="btn btn-warning">Refresh</a>
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