<?php
include ("../include/connection.php");


$id = $_GET['id'];
$query = "UPDATE tbldoctor SET status = 'Rejected' WHERE id = '$id'";
$data = "SELECT * FROM tbldoctor WHERE id = $id";
mysqli_query($connect,$query);
$result = mysqli_query($connect,$data);
$row = mysqli_fetch_array($result);
if($row['role']==1){
	header("location:doctor.php");
}
if($row['role']==2){
	header("location:receptionist.php");
}


?>