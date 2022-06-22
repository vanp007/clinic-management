<?php 
session_start();
if (!(isset($_SESSION['receptionist']))) {
    header("Location:../receptionistlogin.php");
}



function fetch_data(){
include("../include/connection.php");
if (isset($_POST['submit'])){
    $fdate=$_POST['fromdate'];
    $tdate=$_POST['todate'];

    $output='';
    $ret=mysqli_query($connect,"SELECT DISTINCT * FROM tblpatient, tblmed WHERE tblpatient.pid=tblmed.pid AND CAST(tblmed.date_reg as DATE) BETWEEN '$fdate' AND '$tdate'");
   
    while ($row=mysqli_fetch_array($ret)){
        $output.='
                <tr>
                <td>'.$row["pid"].'</td>
                <td>'.$row["firstname"].'</td>
                <td>'.$row["surname"].'</td>
                <td>'.$row["age"].'</td>
                <td>'.$row["email"].'</td>
                <td>'.$row["gender"].'</td>
                <td>'.$row["phone"].'</td>
                <td>'.$row["address"].'</td>
                <td>'.$row["date_reg"].'</td>
                <td>'.$row["lab_results"].'</td>
                <td>'.$row["medicines"].'</td>
                </tr>';
    }

    return $output;
}
 $output.=' <tbody>';
}

if(isset($_POST["generate_pdf"]))  
 {  
      require_once('../assets/tcpdf_min/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("REPORT FROM START DATE TO END DATE");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h4 align="center">Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP</h4><br /> 
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
      $obj_pdf->Output('file.pdf', 'I');  
 }  
 ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>receptionist Dashboard</title>
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>

    <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                        <h5 class="my-3">Report's Dashboard</h5>
                    </div>
                </div>
                            <div class="row">
                                <div class="card-body card-block">
                                        <form method="post" enctype="multipart/form-data" class="form-horizontal" name="bwdatesreport" action="">
                                          <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="text-input" class=" form-control-label">From Date</label>
                                                
                                                    <input type="date" id="fromdate" name="fromdate" value="" class="form-control" required="">
                                                    
                                                </div>
                                            
                                           
                                                <div class="col col-md-4">
                                                    <label for="email-input" class=" form-control-label">To Date</label>
                                                
                                                
                                                    <input type="date" id="todate" name="todate" value="" class="form-control" required="">
                                                  </div>
                                                  <div class="col col-md-4 my-4 py-1">

                                                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Submit
                                        </button> 
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>

                        <div class="row" id="contents">
                            <form method="POST">
                                 <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" >  
                            </form>
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
        <?php echo fetch_data(); ?>

        </table>

    </div>

   </div>
                                                    
</div>
                                            

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script> -->

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>



    <script type="text/javascript">
        
    $(document).ready(function() {
    $('#myList').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );


        /*function Export() {
            html2canvas(document.getElementById('myList'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        }*/



/*
        var specialElementHandlers = {
    // element with id of "bypass" - jQuery style selector
    '.no-export': function (element, renderer) {
        // true = "handled elsewhere, bypass text extraction"
        return true;
    }
};

function exportPDF(id) {
    var doc = new jsPDF('p', 'pt', 'a4');
    //A4 - 595x842 pts
    //https://www.gnu.org/software/gv/manual/html_node/Paper-Keywords-and-paper-size-in-points.html


    //Html source 
    var source = document.getElementById(id);
console.log(source);
    var margins = {
        top: 10,
        bottom: 10,
        left: 10,
        width: 595
    };

    doc.fromHTML(
        source, // HTML string or DOM elem ref.
        margins.left,
        margins.top, {
            'width': margins.width,
            'elementHandlers': specialElementHandlers
        },

        function (dispose) {
            // dispose: object with X, Y of the last line add to the PDF 
            //          this allow the insertion of new lines after html
            doc.save('Test.pdf');
        }, margins);
}
*/
// function createpdf(){
// var doc = new jsPDF()
//   doc.autoTable({ html: '#myList' })
//   doc.save('tablez.pdf')
// }
    </script>

</body>
</html>