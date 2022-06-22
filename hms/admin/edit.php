<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php
	include("../include/header.php");
	include("../include/connection.php");

	?>

	<div class="container-fluid">
		<div class="col-md-12"> 
			<div class="row">
				<div class="col-md-2" style="margin-left:-30px">
					<?php
					include("sidenav.php");
					  ?>
				</div>

				<div class="col-md-10">
					<h4 class="text-center my-3">Edit Doctor</h4>
					<?php
					if (isset($_GET['id'])) {
						$id = $_GET['id'];

						$query = "SELECT * FROM tbldoctor WHERE id = '$id'";
						$resulti = mysqli_query($connect,$query);

						$row = mysqli_fetch_array($resulti);
					}

					?>

					<div class="row">
						<div class="col-md-8">
							<h3 class="">Doctor Details</h3>
							<h5 class="my-3">ID: <?php echo $row['id']; ?></h5>
							<h5 class="my-3">Firstname: <?php echo $row['firstname']; ?></h5>
							<h5 class="my-3">Surname: <?php echo $row['surname'];?></h5>
							<h5 class="my-3">Username: <?php echo $row['username'];?></h5>
							<h5 class="my-3">Email: <?php echo $row['email'];?></h5>
							<h5 class="my-3">Gender: <?php echo $row['gender'];?></h5>
							<h5 class="my-3">Phone number: <?php echo $row['phone'];?></h5>
							<h5 class="my-3">Country: <?php echo $row['country'];?></h5>
							
						</div>
						<div class="col-md-4">
							<h5 class="text-center">Update Password</h5>
							<?php
							if (isset($_POST['submit_password'])) {
								$password = md5($_POST['password']);

								$query = "UPDATE tbldoctor SET password = '$password' WHERE id = '$id'";
								$query_run = mysqli_query($connect,$query);
								if($query_run){
									//echo '<script>alert("Password Changed Successfully!!!")</script>';
									echo "<script> window.onload = 
											function sweet(){
											Swal.fire(
											'',
  											'Password Changed Successfully...!!!!',
  											'success'
											)}
											</script>";

								}else{
									echo "<script> window.onload = 
											function sweet(){
											Swal.fire(
											'',
  											'Something went wrong...!!!!',
  											'error'
											)}
											</script>";
								}
							}
							?>
							<form method="POST">
								<div class="form-group">
									<label>New Password</label>
									<input type="password" name="password" class="form-control" autocomplete="off" value="" placeholder="Enter Password">
								</div><br>
								<input type="submit" name="submit_password" value="Update Password" class="btn btn-success">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>