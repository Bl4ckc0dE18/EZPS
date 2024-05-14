<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payroll</li>
      </ol> -->
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm">
                  
                  
                  <button type="button" class="btn btn-warning btn-sm btn-flat" id="salary_record"><span class="glyphicon glyphicon-print"></span> Print Records</button>

                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Invoice Number</th>
                  <th>Employee Name</th>
                  
                  <th>Gross</th>
                  <th>Deductions</th>      
                  <th>Status</th>
                  <th>Net Pay</th>
                  <th>Applied On</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                       
                    
                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }
                    $look=$user['employee_id'];
                   
                    $sqld = "SELECT * FROM payslip WHERE employee_id like '$look' ";

                    $query = $conn->query($sqld);
                    
                    while($row = $query->fetch_assoc()){
                      if($row['paystatus']=="Pending"){
                        $check = '<span class="label label-warning">Pending</span>' ;
                        }
                       else{
                        $check = '<span class="label label-success">Paid</span>' ;  
                       }
                      echo "
                        <tr>
                          <td>".$row['invoice_id']. "</td>
                          <td>".$row['employee_name']."</td>
                          
                          <td>".$row['gross']."</td>
                          <td>".$row['totaldeduction']."</td>
                          <td>".$check."</td>
                          <td>".$row['netpay']."</td>
                          <td>".$row['datefrom']." - ".$row['dateto']."</td>
                          
                          <td>
                            <a href='#edit' data-toggle='modal' class='btn btn-primary btn-sm btn-flat' id='".$row['invoice_id']."' onclick='redirectToPage2(this)'><i class='fa fa-eye'></i> View</a>
                          </td>
                        </tr>
                      ";
                    }

                  ?>
                  <!-- <button class='btn btn-primary btn-sm btn-flat ' data-id='".$row['invoice_id']."'onclick='redirectToPage2(this)' ><i class='fa fa-eye'></i> View</button> -->
                            
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>

</div>
<?php include 'includes/scripts.php'; ?> 
<script>


function redirectToPage2(tdElement) {
            // Get the ID attribute of the clicked <td> element
            var tdId = tdElement.id;

            // Construct the URL for the next PHP page with the ID as a query parameter
            var nextPageURL = "my_salary.php?id=" + encodeURIComponent(tdId);

            // Redirect to the next PHP page
            window.location.href = nextPageURL;
        }
$(function(){

  $('#salary_record').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'my_salary_record.php');
    $('#payForm').submit();
  });


});



</script>
</body>
</html>
