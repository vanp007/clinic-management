<?php 
session_start();
if (!(isset($_SESSION['receptionist']))) {
	header("Location:../receptionistlogin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>receptionist Dashboard</title>
</head>
<body>
	<?php
	include("../include/header.php");
	include("../include/connection.php");
	?>

	<div class="container-fluid">
			<div class="row">
				<div class="col-md-2" style="margin-left: -30px;">
					<?php
					include("sidenav.php");
					?>
				</div>
				<div class="col-md-10">
					<div class="container-fluid">
						<h5 class="my-3">Receptionist's Dashboard</h5>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3 my-2 bg-info" style="height: 65px;">
									<div class="col-md-12">
										<div class="row text-white">
											<div class="col-md-8">
												<h5 class="text-center my-3">My Profile</h5>
											</div>
											<div class="col-md-4">
												<a href="profile.php"><i class="fa fa-user-circle fa-3x my-2" style="color: white;"></i></a>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-3 my-2 bg-warning mx-4" style="height: 65px;">
									<div class="col-md-12">
										<div class="row text-white">
											<div class="col-md-8">
												<?php
													$total_patient_qry = "SELECT COUNT(*) FROM tblpatient";
        									$res = mysqli_query($connect,$total_patient_qry);
        									$total_patients = mysqli_fetch_array($res)[0];
												 ?>
												<h5 class="text-center my-3"><?= $total_patients;?>  Total Patient</h5>
											</div>
											<div class="col-md-4">
												<a href=""><i class="fa fa-procedure fa-3x my-2" style="color: white;"></i></a>
											</div>
										</div>
									</div>
								</div>


								<!-- <div class="col-md-3 my-2 bg-success" style="height: 65px;">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-8 text-white">
												<h5 class="text-center my-4" style="font-size: 30px;">0</h5>
												<h5 class="text-center my-2">Total Appointment</h5>
											</div>
											<div class="col-md-4">
												<a href=""><i class="fa fa-calendar fa-3x my-2" style="color: white;"></i></a>
											</div>
										</div>
									</div>
								</div> -->
							</div>
						</div>

					<div class="row">
				<div class="col-md-12 my-4">
				<div class="row">
					<div class="col-md-6">
						<a href="patientapply.php" class="btn btn-success">Add Patient</a>
						<a href="index_all.php" class="btn btn-info text-white">All Patient</a>
						<a href="index.php" class="btn btn-secondary">Today's Patient</a>
					</div>
					
					<div class="col-md-6 my-2">
						<!-- <h5 class="text-primary">Search Patients</h5> 
						<b>Search:</b><input class="form-control w-50" id="myInput" type="text" placeholder="Type patient name, patient ID">-->
						<form action="search.php" method="post" class="form-horizontal">
							<div class="form-group row">
								<div class="col-md-10">
									<input type="text" name="search" placeholder="Type patient name, patient ID" class="form-control">
								</div>
								<div class="col-md-2">
									<button type="submit" name="search_qry"  class="form-control btn btn-info"><i class="fa fa-search"></i></button>
								</div>
						</div>
						</form>
					</div>
				</div>
		
				<h4 class="text-center">Today's Patients List</h4>
			<table id="myList" class="table table-bordered">
        <thead>
            <tr>
            <th>ID</th>
			<th>Firstname</th>
			<th>Surname</th>
			<th>Age</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Phone</th>
			<th>Country</th>
			<th>Date Registrated</th>
			<th>Address</th>
			<th colspan="2">Action</th>
            </tr>
        </thead>

        <?php
        	if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM tblpatient";
        $result = mysqli_query($connect,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


			$today = date('Y-m-d');

			
				$query = "SELECT * FROM tblpatient WHERE CAST(tblpatient.date_reg as DATE) = '$today' ORDER BY date_reg DESC LIMIT $offset, $no_of_records_per_page";
			

			$result = mysqli_query($connect,$query);

			while($row = mysqli_fetch_array($result)){ ?>
        <tbody>
        	<tr>
		<td><?= $row['pid']; ?></td>
		<td><?=strtoupper($row['firstname']); ?></td>
		<td><?= strtoupper($row['surname']); ?></td>
		<td><?= $row['age']; ?></td>
		<td><?= $row['email']; ?></td>
		<td><?= strtoupper($row['gender']); ?></td>
		<td><?= $row['phone']; ?></td>
		<td><?= strtoupper($row['country']); ?></td>
		<td><?= $row['date_reg']; ?></td>
		<td><?= strtoupper($row['address']); ?></td>
		<td>
			<a href="patientupdate.php?pid=<?= $row['pid']; ?>">
			<button class='btn btn-primary'>Update</button>
			</a>
		</td>
	</tr>
            
            <?php } ?>
   </tbody>
</table>
<a class="btn btn-info" href="?pageno=1">First</a>
<a  class="btn btn-info <?php if($pageno <= 1){ echo 'disabled'; } ?>" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        
<a class="btn btn-info <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>"href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        
<a class="btn btn-info" href="?pageno=<?php echo $total_pages; ?>">Last</a>
    

			
				</div>


								
						</div>
					</div>
				</div>
			</div>
			
	</div>



<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

// $(document).ready(function() {
//     $('#myList').DataTable();
// } );

</script>

</body>
</html>