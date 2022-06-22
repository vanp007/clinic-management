<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add Admin Page</title>
</head>
<body>
	<?php
	include("../include/header.php");
	include("../include/connection.php");
	?>

	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2" style="margin-left:-30px;">

					<?php

					include("sidenav.php");
					include("../include/connection.php");

					?>
				</div>

				<div class="col-md-10">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<h4 class="text-center">All admin</h4>
								<?php
									$ad = $_SESSION['admin'];
									$query = "SELECT * FROM tbladmin WHERE username != '$ad'";
									$res = mysqli_query($connect,$query);

									$output = "<table class='table table-responsive table-bordered'>
									<tr>
									<th>ID</th>
									<th>Username</th>
									<th style='width: 10%;'>Action</th><tr>";

									if (mysqli_num_rows($res) < 1) {
										$output .="<tr><td class='text-center'>No Admin Found</td></tr>";
									}

									while($row = mysqli_fetch_array($res)){
										$id = $row['id'];
										$username = $row['username'];

										$output .= "

										<tr>
										<td>$id</td>
										<td>$username</td>
										<td>
											<a href='admin?id=$id'><button id='$id' class='btn btn-danger'>Remove</button></a>
										</td>


										";
									}

										$output .= "
										</tr>
								</table>

										";

										echo $output;



										if (isset($_GET['id'])) {
											$id = $_GET['id'];


											$query = "DELETE FROM tbladmin WHERE id='$id'";
											mysqli_query($connect,$query);
										}

								?>
								

									
									
							</div>
							<div class="col-md-6">
								<?php
								if (isset($_POST['add'])) {
									$uname = $_POST['uname'];
									$pass = $_POST['pass'];
									$image = $_FILES['img']['name'];

									$error = array();



									if (empty($uname)) {
										$error ['u'] = "Enter Username";
									}else if (empty($pass)) {
										$error ['u'] = "Enter Password";
									}else if (empty($image)) {
										$error ['u'] = "Add Picture";
									}



									if (count($error) == 0) {
										$data = "INSERT INTO tbladmin(username,password,profile)VALUES('$uname','$pass','$image')";


										$result = mysqli_query($connect,$data);

										if($result){
											move_uploaded_file($_FILES['img']['tmp_name'], "img/$image");
										}else{

										}
									}
								}





								if (isset($error['u'])) {
									$erdisplay = $error['u'];
									$show = "<h5 class='text-center alert alert-danger'>$erdisplay</h5>";
								}else{
									$show = "";
								}
								?>
								<h4 class="text-center">Add admin</h4>
								<div>
									<?php echo $show; ?>
								</div>

								<form method="POST" enctype="multipart/form-data">
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="uname" class="form-control" autocomplete="off">
									</div>

									<div class="form-group">
										<label>Password</label>
										<input type="password" name="pass" class="form-control">
									</div>

									<div class="form-group">
										<label>Add Picture</label>
										<input type="file" name="img" class="form-control" autocomplete="off">
									</div><br>

									<input type="submit" name="add" value="Add New Admin" class="btn btn-success">
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