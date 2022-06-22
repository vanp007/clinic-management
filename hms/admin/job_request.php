<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Request</title>
</head>
<body>
	<?php
	include("../include/header.php");

	include("../include/connection.php");
	?>

	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2" style="margin-left: -30px;">
					<!--Sidenav-->
					<div class="list-group bg-primary" style="height: 92vh;">
					 
						<?php
						include ("sidenav.php");

						?>
					</div>
					<!-- endsSidenav-->
				</div>

				<div class="col-md-10">
						<h5 class="text-center my-3">Job Request</h5>
						<div id="show"></div>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		$(document).ready(function(){
			//alert("Done");

				show();
			function show(){
				$.ajax({
					url:"ajax_job_request.php",
					method:"POST",
					success:function(data){
						$("#show").html(data);
					}
				})
			}

			$(document).on('click', '.approve', function(){
				//alert("Okay");

				var id = $(this).attr("id");
				alert(id);

				$.ajax({
					url:"ajax_approve.php",
					method:"POST",
					data:{id:id},
					success:function(data) {
						show();
					}
				})
			})

			$(document).on('click', '.reject', function(){
				//alert("Okay");

				var id = $(this).attr("id");
				alert(id);

				$.ajax({
					url:"ajax_reject.php",
					method:"POST",
					data:{id:id},
					success:function(data) {
						show();
					}
				})
			})

		});
	</script>
</body>
</html>