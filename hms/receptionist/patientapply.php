<?php
session_start();
include("../include/connection.php");

if (isset($_POST['apply'])) {
	$firstname = $_POST['fname'];
	$surname = $_POST['sname'];
	$age = $_POST['age'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$phone = $_POST['phone'];
	$country = $_POST['country'];
	$address = $_POST['address'];
	

	$error = array();

	if(empty($firstname)){
		$error['apply'] = "Enter Firstname";
	}else if(empty($surname)) {
		$error['apply'] = "Enter Surname";
	}else if(empty($age)) {
		$error['apply'] = "Enter Age";
	}else if(empty($email)){
		$error['apply'] = "Enter Email";
	}else if($gender == ""){
		$error['apply'] = "Select Your Gender";
	}else if(empty($phone)){
		$error['apply'] = "Enter Your Phone Number";
	}else if($country == ""){
		$error['apply'] = "Select Your Country";
	}else if(empty($address)){
		$error['apply'] = "Enter Home address";
	}

	if(count($error) == 0){
		$data = "SELECT id FROM tblpatient ORDER BY id DESC LIMIT 1";
		$result1 = mysqli_query($connect,$data);
		if(mysqli_num_rows($result1)>0){
			$row = mysqli_fetch_array($result1);
			$id = $row['id'];
			$pid = 'MVD-'.($id+1);
		}else{
			$pid = 'MVD-1';
		}
		$query = "INSERT INTO tblpatient(pid, firstname, surname, age, email, gender, phone, country,date_reg, address) VALUES('$pid','$firstname','$surname','$age','$email','$gender','$phone','$country',NOW(),'$address')";


		$result = mysqli_query($connect,$query);

		if ($result) {
			echo "<script>alert('Patient Registered Successfully')</script>";

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
					<h4>New <span class="text-primary">Patient</span> Registration</h4>
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
							<label>Age</label>
							<input type="text" name="age" class="form-control" autocomplete="off" placeholder="Eg. 6 months or 1 year" value="<?php if(isset($_POST['age'])) echo $_POST['age']; ?>">
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
						</div>

						<div class="form-group">
							<label>Select Gender</label>         <i class="fa fa-caret-down"></i>
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
							<label>Select Country</label>         <i class="fa fa-caret-down"></i>
							<select name="country" class="form-control">
								<option value="">Select Country</option>
								<option value="Tanzania">Tanzania</option>
								<option value="Kenya">Kenya</option>
							</select>
						</div>


						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" class="form-control" autocomplete="off" placeholder="Enter Address">
						</div>

						<br>

						<input type="submit" name="apply" value="Register" class="btn btn-success">
						<a href="index.php" style="text-decoration: none;" class="btn btn-warning text-white mx-3">Back</a>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>