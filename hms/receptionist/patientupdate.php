<?php
session_start();
include("../include/connection.php");

$pid = $_GET['pid'];
//geting data of selected patient
$data = "SELECT * FROM tblpatient WHERE pid = '$pid'";
$result1 = mysqli_query($connect,$data);
$row = mysqli_fetch_array($result1);


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
		
		$query = "UPDATE tblpatient SET 
		firstname='$firstname', 
		surname='$surname', 
		age='$age', 
		email='$email', 
		gender='$gender', 
		phone='$phone', 
		country='$country',
		address='$address' WHERE pid = '$pid'";


		$result = mysqli_query($connect,$query);

		if ($result) {
			echo "<script>alert('Patient Updated Successfully')</script>";

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
					<h4>Patient<span class="text-primary">Details</span> Update</h4>
					<div>
						<?php
							echo $show;
						?>
					</div>
					<div>
						Patient ID: <input type="text" name="pid" value="<?= $pid; ?>" readonly="on" class="form-control w-50">
					</div>
					<form method="POST">
						<div class="form-group">
							<label>Firstname</label>
							<input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter Firstname" value="<?= $row['firstname']; ?>">
						</div>

						<div class="form-group">
							<label>Surname</label>
							<input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Enter Surname" value="<?= $row['surname']; ?>">
						</div>

						<div class="form-group">
							<label>Age</label>
							<input type="text" name="age" class="form-control" autocomplete="off" placeholder="Eg. 6 months or 1 year" value="<?= $row['age']; ?>">
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email" value="<?= $row['email']; ?>">
						</div>

						<div class="form-group">
							<label>Select Gender</label>
							<select name="gender" class="form-control">
								<option value="<?= $row['gender']; ?>" selected><?= $row['gender']; ?></option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</div>

						<div class="form-group">
							<label>Phone Number</label>
							<input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone" value="<?= $row['phone']; ?>">
						</div>

						<div class="form-group">
							<label>Select Country</label>
							<select name="country" class="form-control">
								<option value="<?= $row['country']; ?>" selected=""><?= $row['country']; ?></option>
								<option value="Tanzania">Tanzania</option>
								<option value="Kenya">Kenya</option>
							</select>
						</div>


						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" class="form-control" autocomplete="off" placeholder="Enter Address" value="<?= $row['address']; ?>">
						</div>

						<br>

						<input type="submit" name="apply" value="Update" class="btn btn-success">
						<a href="index.php" style="text-decoration: none;" class="btn btn-warning text-white mx-3">Back</a>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>