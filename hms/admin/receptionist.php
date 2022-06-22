<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Receptionist Page</title>
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
					<h4 class="text-center">Total Receptionists</h4>
					<?php
					$query = "SELECT * FROM tbldoctor where role = 2 ORDER BY data_reg ASC";

					$result = mysqli_query($connect,$query);


					$output = "";

$output .= "
	<table class='table table-bordered'>
		<tr>
			<td>ID</td>
			<td>Firstname</td>
			<td>Surname</td>
			<td>Username</td>
			<td>Email</td>
			<td>Gender</td>
			<td>Phone</td>
			<td>Country</td>
			<td>Date Registrated</td>
			<td colspan='2'>Action</td>
			</tr>

		

	 ";

	if(mysqli_num_rows($result) < 1){
		$output ."
			<tr>
				<td colspan='8'>No Job Request Yet</td>
			</tr>
		";
	}

	while($row = mysqli_fetch_array($result)){
		$output .="

		<tr>
		<td>".$row['id']."</td>
		<td>".$row['firstname']."</td>
		<td>".$row['surname']."</td>
		<td>".$row['username']."</td>
		<td>".$row['email']."</td>
		<td>".$row['gender']."</td>
		<td>".$row['phone']."</td>
		<td>".$row['country']."</td>
		<td>".$row['data_reg']."</td>
		<td>
			<a href='edit.php?id=".$row['id']."'>
			<button class='btn btn-primary'>Edit</button>
			</a>
		</td>";
	
		if($row['status']=='Rejected'){
			$output.="<td>
			<a href='ajax_approve.php?id=".$row['id']."'>
			<button class='btn btn-danger'>Activate</button>
			</a>

		</td>"; 
		}
		if($row['status']=='Approved'){
			$output.="<td>
			<a href='ajax_reject.php?id=".$row['id']."'>
			<button class='btn btn-success'>Deactivate</button>
			</a>

		</td>"; 
		}
		
	}

	$output.= "
	</tr>
	</table>



	";
	echo $output;


					?>
					<a href="receptionistRegister.php" class="btn btn-success">Add New Receptionist</a>
				</div>
			</div>
		</div>
		
	</div>

</body>
</html>