<?php
session_start();
include("include/connection.php");

if (isset($_POST['login'])) {
	$uname = $_POST['uname'];
	$password = $_POST['pass'];


	$error = array();

	$query = "SELECT * FROM tbldoctor WHERE username = '$uname' AND password = '$password'";

	$data = mysqli_query($connect,$query);

	$row = mysqli_fetch_array($data);


	if (empty($uname)) {
		$error['login'] = "Enter Username";
	}else if(empty($password)){
		$error['login'] = "Enter Password";
	}else if($row['status'] == "Rejected"){
		$error['login'] = "Opps! You cannot login. Please contact your administrator!";
	}


	if(count($error) == 0){
		$data2 = "SELECT * FROM tbldoctor WHERE username = '$uname' AND password = '$password'";
		$result = mysqli_query($connect,$data2);

		if(mysqli_num_rows($result)) {
			echo "<script>alert('Done')</script>";
			$_SESSION['receptionist'] = $uname;
			header("Location:receptionist/index.php");

		}else{
			//echo "<script>alert('Account does not exist')</script>";
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


if(isset($error['login'])){
	$accountError = $error['login'];

	$show ="<h5 class='text-center alert alert-danger'>$accountError</h5>";
}else{
	$show ="";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Rceptionist Login</title>
</head>
<body>
	<?php
	include("include/header.php");


	 ?>

	 <div class="container-fluid">
	 	<div class="col-md-12">
	 		<div class="row">
	 			<div class="col-md-3">
	 			</div>
	 			<div class="col-md-6 shadow my-3">
	 				<div class="row">
	 					<div class="col-12 text-center my-1">
	 						<h4 class="text-center">Receptionist Login</h4>
	 						<img src="img/doc.jpg" class="img w-25">
	 					</div>
	 				</div>
	 				<div>
	 					<?php
	 					echo $show;

	 					?>
	 				</div>
	 				<form method="POST" class="">
	 					<div class="form-group">
	 						<label>Username</label>
	 						<input type="text" name="uname" class="form-control" placeholder="Enter Username" autocomplete="off">
	 					</div>

	 					<div class="form-group">
	 						<label>Password</label>
	 						<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
	 					</div><br>

	 					<input type="submit" name="login" class="btn btn-success" value="Login">
	 					<div>
	 						<br>
	 					</div>
	 				</form>
	 			</div>

	 			<?php include("include/footer.php"); ?>
	 		</div>
	 	</div>
	 </div>

</body>
</html>