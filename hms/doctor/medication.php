<?php
session_start();
include("../include/connection.php");
if (!(isset($_SESSION['doctor']))) {
	header("Location:../doctorlogin.php");
}


if (isset($_POST['medsub'])) {
	$pid = $_POST['pid'];
	$lab_results = $_POST['lab_results'];
	$med = $_POST['med'];

	$error = array();

	if(empty($lab_results)){
		$error['medsub'] = "Enter Lab Results";
	}else if(empty($med)) {
		$error['medsub'] = "Enter Medicines";
	}

	if(count($error) == 0){
		$query = "INSERT INTO tblmed(pid,lab_results,medicines,date_reg) VALUES('$pid','$lab_results','$med',NOW())";

		$result = mysqli_query($connect,$query);

		if ($result) {
			echo "<script>alert('Data Saved Successfully')
			window.location.replace('index.php')
			</script>";

			//header("Location: index.php");
		}else{
			echo "<script>alert('Failed')</script>";
		}
	}
}

	if(isset($error['medsub'])){
		$s = $error['medsub'];


		$show = "<h5 class='text-center alert alert-danger'>$s</h5>";
	}else{
		$show = "";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Medication Form</title>
</head>
<body>
	<?php
	include("../include/header.php");
	include("../include/connection.php");
	?>
<br><br><br>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 shadow">
					<h4><b>Patient Lab Results and Medicines</b></h4>
					<div>
						<?php
							echo $show;
						?>
					</div>
					<form method="POST">
						<?php

							$pid = $_GET['pid'];
							$qry = "SELECT * FROM tblpatient WHERE pid = '$pid' ";
							$rst = mysqli_query($connect, $qry);
							$rw = mysqli_fetch_array($rst);
						?>
						<div class="form-group" action="#">
							<label>Patient ID</label>
							<input type="text" name="pid" class="form-control" autocomplete="off" readonly="on" value="<?= $rw['pid']; ?>"> 
						</div><br>

						<div class="form-group">
							<label>Lab Results</label>
							<textarea type="text" name="lab_results" class="form-control" autocomplete="off" placeholder="Enter results" value="<?php if(isset($_POST['lab_results'])) echo $_POST['lab_results']; ?>"></textarea>
						</div><br>

						<div class="form-group">
							<label>Medicines</label>
							<textarea type="text" name="med" class="form-control" autocomplete="off" placeholder="list of prescibed medicines" value="<?php if(isset($_POST['med'])) echo $_POST['med']; ?>"></textarea>
						</div>

						<br>

						<input type="submit" name="medsub" value="Register" class="btn btn-success">
						<a href="index.php" style="text-decoration: none;" class="btn btn-warning text-white mx-3">Back</a>
						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>