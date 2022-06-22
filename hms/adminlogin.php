<?php
session_start();
include("include/connection.php");
if (isset($_POST['login'])) {
	$username = $_POST['uname'];
	$password = $_POST['pass'];

	$error = array();

	if(empty($username)){
		$error['admin'] = "Enter username";
	}

	else if(empty($password)){
		$error['admin'] ="Enter Password";
	}
	
	if(count($error)==0){
		$query = "SELECT * FROM tbladmin WHERE username = '$username' AND password = '$password'";

		$result = mysqli_query($connect, $query);

		if(mysqli_num_rows($result) == 1){
			echo "<script>alert('You have login as Admin')</script>";

			$_SESSION['admin'] = $username;
			header("Location:admin/index.php");
		}else{
			echo "<script> window.onload = 
				function sweet(){
				Swal.fire(
				'',
  				'Incorrect Username or Password',
  				'error'
				)}
				</script>";
		}
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Login page</title>
</head>
<body>
	<?php
		include("include/header.php");

	 ?>

	 <div class="container-fluid">
	 	<div class="col-md-12">
	 		<div class="row">
	 			<div class="col-md-3"></div>
	 			<div class="col-md-6 shadow my-2">
	 				<div class="row">
	 					<div class="col-12 text-center my-1">
	 						<h4 class="text-center">Admin Login</h4>
	 						<img src="img/ad.png" class="img w-25">
	 					</div>
	 				</div>
	 
	 				<form method="POST" class="">

	 					<div>
	 						<?php
	 						if (isset($error['admin'])) {
	 							$sho = $error['admin'];

	 							$show = "<h4 class='alert alert-danger'>$sho</h4?";
	 						}
	 						else{
	 							$show = "";
	 						}

	 						echo $show;

	 						?>
	 					</div>

	 					<div class="form-group">
	 						<label>Username</label>
	 						<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
	 					</div><br>

	 					<div class="form-group">
	 						<label>Password</label>
	 						<input type="password" name="pass" class="form-control" placeholder="Enter Password">
	 					</div><br>

	 					<input type="submit" name="login" class="btn btn-success" value="Login">
	 				</form><br>
	 			</div>
	 			<?php include("include/footer.php"); ?>
	 		</div>
	 	</div>
	 </div>

</body>
</html>