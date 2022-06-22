<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Details</title>
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
			
			?>	
			</div>

			<div class="col-md-10">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<h5 class="text-center">All admin</h5>
							<?php
							$ad = $_SESSION['admin'];
							$query = "SELECT * FROM tbladmin WHERE username !='$ad' ";
							$result = mysqli_query($connect,$query);

							$output = "<table class='table table-responsive table-bordered'>
							<tr>
								<th>ID</th>
								<th>Username</th>
								<th style='width: 10%;'>Action</th><tr>"

								;

							if (mysqli_num_rows($result) < 1) {
								$output .= "<tr><td> class='text-center'>No New Admin</td></tr>";
							}

							while($row = mysqli_fetch_array($result)){
								$id = $row['id'];
								$username = $row['username'];

								$output .="<tr>
									<td>$id</td>
									<td>$username</td>
									<td>
										<button id='$id' class='btn btn-danger'>Remove</button>
									</td> ";
							}

							$output="</tr>
								
							</table>";

							echo $output;

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
									$error['u']  = "Enter Username";	
								}else if(empty($pass)){
									$error['u'] = "Enter Password";
								} else if (empty($image)) {
									$error['u'] = "Enter Profile Picture";
								}


								if (count($error) == 0) {
									$fill_data = "INSERT INTO tbladmin(username,password,profile)VALUES('$uname','$pass','$image')";

									$result = mysqli_query($connect,$fill_data);

									if ($result) {
										move_uploaded_file($_FILES['img']['tmp_name'], "img/$image");
									}else{

									}
								}
							}
							?>
							<h5 class="text-center">Add New Admin</h5>
							<form method="POST" enctype="multipart-/form-data">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="uname" class="form-control" autocomplete="off">
								</div>


								<div class="form-group">
									<label>Password</label>
									<input type="password" name="pass" class="form-control">
								</div>

								<div class="form-group">
									<label>Add Image</label>
									<input type="file" name="img" class="form-control">
								</div>
								<div class="form-group"><br></div>

								<input type="submit" name="add" value="Add new admin" class="btn btn-success">
								
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