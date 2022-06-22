<?php 
session_start();
if (!(isset($_SESSION['receptionist']))) {
	header("Location:../receptionistlogin.php");
}

if (isset($_POST['submit'])){
    $fdate=$_POST['fromdate'];
    $tdate=$_POST['todate'];
    
    $_SESSION['fromdate']=$fdate;
    $_SESSION['todate']=$tdate;

    header('location:print.php');

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
		<div class="row">		
            <h5 class="my-3">Report's Dashboard</h5>
        </div>

		<div class="row">
			<div class="card-body card-block">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">From Date</label>
                            <input type="date" name="fromdate" class="form-control" required="">
                        </div>

                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">To Date</label>
                            <input type="date" name="todate" class="form-control" required="">
                        </div>

                        <div class="col col-md-4 my-4 py-1">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <?php
        include("../include/footer.php");
    ?>
    </div>
</body>
</html>