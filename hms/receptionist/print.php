<?php 
session_start();
if (!(isset($_SESSION['receptionist']))) {
	header("Location:../receptionistlogin.php");
}




function fetch_data(){
include("../include/connection.php");
$output='';
$fdate=$_SESSION['fromdate'];
$tdate=$_SESSION['todate'];
	$ret=mysqli_query($connect,"SELECT DISTINCT * FROM tblpatient, tblmed WHERE tblpatient.pid=tblmed.pid AND CAST(tblmed.date_reg as DATE) BETWEEN '$fdate' AND '$tdate'");
	while ($row=mysqli_fetch_array($ret)){
		$output.='
   				<tr>
				<td>'.$row["pid"].'</td>
				<td>'.strtoupper($row["firstname"]).'</td>
				<td>'.strtoupper($row["surname"]).'</td>
				<td>'.$row["age"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.strtoupper($row["gender"]).'</td>
				<td>'.$row["phone"].'</td>
				<td>'.strtoupper($row["address"]).'</td>
				<td>'.$row["date_reg"].'</td>
				<td>'.$row["lab_results"].'</td>
				<td>'.$row["medicines"].'</td>
				</tr>';
	}

	return $output;
}

if(isset($_POST["generate_pdf"]))  
 { 
$fdate=$_SESSION['fromdate'];
$tdate=$_SESSION['todate'];
      require_once('../assets/tcpdf_min/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("REPORT FROM DATE TO DATE");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 8);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '   
      <h4 align="center">VIGAENI DISPENSARY - REPORT FROM  ' .$fdate. ' TO  '.$tdate. '</h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <thead>
            <tr>
            <th>ID</th>
			<th>Firstname</th>
			<th>Surname</th>
			<th>Age</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Phone</th>
			<th>Address</th>
			<th>Date</th>
			<th>Case</th>
			<th>Medicine</th>
            </tr>
        </thead>
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('Patient Report.pdf', 'I');  
 }  
 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Report Print</title>
   
</head>
<body>
	<?php
	include("../include/header.php");
	//include("../include/connection.php");
	?>

	<div class="container-fluid">
		<div class="row">
            <div class="col-md-2 my-4">
                <form method="POST">
                    <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" >  
                </form>
            </div>
			<div class="col-md-3 my-4">
                <a href="report.php" class="btn btn-danger">Cancel</a>
            </div>
        </div>
                         
        <div class="row">      
	       <div class="col-md-12 my-4">
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
            			<th>Address</th>
            			<th>Date</th>
            			<th>Case</th>
            			<th>Medicine</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo fetch_data(); ?>
                </tbody>
                
		      </table>
			</div>
		</div>                                      
    </div>

</body>
</html>