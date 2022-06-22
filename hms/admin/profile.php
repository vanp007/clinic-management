<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Profile</title>
</head>
<body>
	<?php
	include("../include/header.php");
	include("../include/connection.php");

	$ad = $_SESSION['admin'];
	$query = "SELECT * FROM tbladmin WHERE username = '$ad'";
	$res = mysqli_query($connect, $query);

	while($row = mysqli_fetch_array($res)){
		$username = $row['username'];
		$profile = $row['profile'];
	}

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
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<h4 class="text-center"><?php echo $username;?> Profile</h4>
								<form method="POST" class="multipart/form-data">
									<?php
									echo "<img src='img/$profile' class='col-md-4' style='height: 200px;'>";
									?><br>

									<div class="form-group">
										<label>UPDATE PROFILE</label>
										<input type="file" name="profile" class="form-control">
									</div><br>
									<input type="submit" name="update" value="UPDATE" class="btn btn-success">
								</form>
							</div>

							<div class="col-md-6">
								<form method="POST">
									<label>Change Username</label>
									<input type="text" name="uname" class="form-control" autocomplete="off"><br>
									<input type="submit" name="change" class="btn btn-success" value="Change">
								</form>

								<br><br>


								<?php

								if (isset($_POST['update_password'])) {
									$old_pass = $_POST['old_pass'];
									$new_pass = $_POST['new_pass'];
									$confirm_pass = $_POST['confirm_pass'];


									$error = array();

									$old = mysqli_query($connect, "SELECT * FROM tbladmin WHERE username = '$ad'");

									$row = mysqli_fetch_array($old);
									$pass = $row['password'];


									if (empty($old_pass)) {
										$error ['p'] = "Old Password";
									}else if (empty($old_pass)) {
										$error ['p'] = "New Password";
									}else if (empty($old_pass)) {
										$error ['p'] = "Confirm Password";
									}else if($old_pass != $pass){
										$error['p'] = 'Invalid Old Password';
									}else if($new_pass != $confirm_pass){
										$error['p'] = 'Password does not match';				
									}

								}


								if (isset($error['p'])) {
									$erdisplay = $error['p'];
									$show = "<h5 class='text-center alert alert-danger'>$erdisplay</h5>";
								}else{
									$show = "";
								}





								?>
								<form method="POST">
									<h4 class="text-center">Change Password</h4>
									<div>
										<?php 
										echo $show;
										?>
									</div>
									<div class="form-group">
										<label>Old Password</label>
										<input type="password" name="old_pass" class="form-control">
									</div>

									<div class="form-group">
										<label>New_password</label>
										<input type="password" name="new_pass" class="form-control">
									</div>

									<div class="form-group">
										<label>Confirm Password</label>
										<input type="password" name="confirm_pass" class="form-control">
									</div><br>
									<input type="submit" name="update_password" value="Update Password" class="btn btn-success">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>