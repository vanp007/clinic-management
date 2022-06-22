<?php
include("../include/connection.php");

session_start();
if (!(isset($_SESSION['admin']))) {
	header("Location:../adminlogin.php");
}	

if (isset($_POST['apply'])) {
	$firstname = $_POST['fname'];
	$surname = $_POST['sname'];
	$username = $_POST['uname'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$phone = $_POST['phone'];
	$country = $_POST['country'];
	$password = $_POST['pass'];
	$confirm_pass = $_POST['c_pass'];

	$error = array();

	if(empty($firstname)){
		$error['apply'] = "Enter Firstname";
	}else if(empty($surname)) {
		$error['apply'] = "Enter Surname";
	}else if(empty($username)) {
		$error['apply'] = "Enter Username";
	}else if(empty($email)){
		$error['apply'] = "Enter Email";
	}else if($gender == ""){
		$error['apply'] = "Select Your Gender";
	}else if(empty($phone)){
		$error['apply'] = "Enter Your Phone Number";
	}else if($country == ""){
		$error['apply'] = "Select Your Country";
	}else if(empty($password)){
		$error['apply'] = "Enter Password";
	}else if($confirm_pass != $password){
		$error['apply'] = "Password does not match";
	}

	if(count($error) == 0){
		$query = "INSERT INTO tbldoctor(firstname, surname, username, email, gender, phone, country, password, role, data_reg, status,profile) VALUES('$firstname','$surname','$username','$email','$gender','$phone','$country','$password','2',NOW(),'Approved','receptionist.jpg')";


		$result = mysqli_query($connect,$query);

		if ($result) {
			echo "<script>alert('Receptionist Registered Seccessfully')</script>";

			header("Location: index.php");
		}else{
			echo "<script>alert('Registration Failed')</script>";
		}
	}
}

	if(isset($error['apply'])){
		$s = $error['apply'];


		$show = "<h5 class='text-center alert alert-danger'>$s</h5>";
	}else{
		$show = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Regisration Form</title>
</head>
<body>
	<?php
	include("../include/header.php");
	include("../include/connection.php");
	?>

	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 shadow">
					<h4>Register Now!!</h4>
					<div>
						<?php
							echo $show;
						?>
					</div>
					<form method="POST">
						<div class="form-group">
							<label>Firstname</label>
							<input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter Firstname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
						</div>

						<div class="form-group">
							<label>Surname</label>
							<input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Enter Surname" value="<?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">
						</div>

						<div class="form-group">
							<label>Username</label>
							<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Usernme" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
						</div>

						<div class="form-group">
							<label>Select Gender: <i class="fa fa-caret-down"></i></label>
							<select name="gender" class="form-control">
								<option value="">Select Gender</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</div>

						<div class="form-group">
							<label>Phone Number</label>
							<input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
						</div>

						<div class="form-group">
							<label>Select Country: <i class="fa fa-caret-down"></i></label>
							<select name="country" class="form-control">
								<option value="">Select Country</option>
								<option value="Tanzania">Tanzania</option>
								<option value="Kenya">Kenya</option>
							</select>
						</div>


						<div class="form-group">
							<label>Password</label>
							<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
						</div>

						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" name="c_pass" class="form-control" autocomplete="off" placeholder="Confirm Password">
						</div><br>

						<input type="submit" name="apply" value="Register" class="btn btn-success">
						<a href="index.php" class="btn btn-primary">Back</a>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>