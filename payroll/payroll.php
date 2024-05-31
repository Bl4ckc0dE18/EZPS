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
  <?php $position = $user['position']; ?>
    <?php if($position == 'Admin' ||$position == 'Accountant' ){?>
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
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="generate"><span class="glyphicon glyphicon-print"></span> Generate</button>
                  <button type="button" class="btn btn-warning btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Payroll</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Invoice Number</th>
                  <th>Employee Name</th>
                  <th>Employee ID</th>
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
                    $from = date('Y-m-d', strtotime('-15 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }
                     
                    

                    //$sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";
                    $sqld = "SELECT * FROM payslip WHERE datefrom >= '$from' AND dateto <= '$to'";
                     //$sqld = "SELECT * FROM payslip ";
                    $query = $conn->query($sqld);
                    //$status = ($row['paystatus'])?'<span class="label label-danger pull-right">Paid</span>':'<span class="label label-warning pull-right">Pending</span>';
                    
                    while($row = $query->fetch_assoc()){
                      if($row['paystatus']=="Pending"){
                        $check = '<span class="label label-warning">Pending</span>' ;
  
                       
                        
                       }
                       else{
                        $check = '<span class="label label-success">Paid</span>' ;
                       }
                      echo "
                        <tr>
                          <td>".$row['invoice_id']."</td>
                          <td>".$row['employee_name']."</td>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['gross']."</td>
                          <td>".$row['totaldeduction']."</td>
                          <td>".$check."</td>
                          <td>".$row['netpay']."</td>
                          <td>".$row['datefrom']." - ".$row['dateto']."</td>
                          
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                            <button class='btn btn-primary btn-sm btn-flat 'id='".$row['invoice_id']."'onclick='redirectToPage2(this)' ><i class='fa fa-eye'></i> View</button>

                          </td>
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php
}else{
 include 'includes/autorize.php';
}?> 
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/payroll_modal.php'; ?>
  
</div>
<?php include 'includes/scripts.php'; ?> 
<script>
function redirectToPage2(tdElement) {
            // Get the ID attribute of the clicked <td> element
            var tdId = tdElement.id;

            // Construct the URL for the next PHP page with the ID as a query parameter
            var nextPageURL = "my_salary?id=" + encodeURIComponent(tdId);

            // Redirect to the next PHP page
            
            window.open(nextPageURL, '_blank');
        }
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'payroll?range='+range;
  });

  $('#generate').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_pay');
    $('#payForm').submit();
  });

  $('#payroll').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_generate');
    $('#payForm').submit();
  });

  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payslip_generate');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'payroll_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.decid').val(response.id);
      $('#del_payroll').html(response.invoice_id);
      $('#edit_status').val(response.paystatus);
     
      
      
    }
  });
}


</script>
</body>
</html>
