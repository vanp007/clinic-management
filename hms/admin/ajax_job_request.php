<?php
include("../include/connection.php");

$query = "SELECT * FROM tbldoctor WHERE status = 'Pendding' ORDER BY data_reg ASC";
$result =  mysqli_query($connect,$query);

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
			<td>Action</td>
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
			<div class='col-md-12'>
				<div class='row'>
					<div class='col-md-6'>
						<button id='".$row['id']."' class='btn btn-success approve'>Approve</button>
					</div>
					<div class='col-md-6'>
						<button id='".$row['id']."' class='btn btn-danger reject'>Reject</button>
					</div>
				</div>
			</div>
		</td>

		"; 
	}

	$output.= "
	</tr>
	</table>



	";
	echo $output;


?>