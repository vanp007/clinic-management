<?php 
session_start();
if (!(isset($_SESSION['doctor']))) {
	header("Location:../doctorlogin.php");
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
			<th>Action</th>
            </tr>
        </thead>

<?php
if (isset($_POST['search_qry'])){
    $search=$_POST['search'];

    $query = "SELECT * FROM tblpatient WHERE pid LIKE '%$search%' OR firstname LIKE '%$search%' OR surname LIKE '%$search%'";
	$result = mysqli_query($connect,$query);
	if(mysqli_num_rows($result)>0){	
	while($row = mysqli_fetch_array($result)){ ?>
        <tbody>
        	<tr>
		<td><?= $row['pid']; ?></td>
		<td><?= $row['firstname']; ?></td>
		<td><?= $row['surname']; ?></td>
		<td><?= $row['age']; ?></td>
		<td><?= $row['email']; ?></td>
		<td><?= $row['gender']; ?></td>
		<td><?= $row['phone']; ?></td>
		<td><?= $row['country']; ?></td>
		<td><?= $row['date_reg']; ?></td>
		<td><?= $row['address']; ?></td>
		<td>
			<a href="medication.php?pid=<?= $row['pid']; ?>">
			<button class='btn btn-success'>Medical</button>
			</a>

		</td>
	</tr>
            
            <?php
             } 
         }else{?>
        	<tr>
        	<td class="text-center" colspan="12">Not Found</td>
        	</tr>

        <?php }}

             ?>
   </tbody>
</table>
<a href="index.php" class="btn btn-danger">Back</a>
</body>
</html>

