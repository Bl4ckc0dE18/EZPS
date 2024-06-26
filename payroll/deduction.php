<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  
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
        Deduction and Loan Records
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
            <a href="#print" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-print"></i> Print</a>
              
            <a href="#list" data-toggle="modal" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-print"></i> List</a>
           <!-- <div class="pull-right">
              
                 <form method="POST" class="form-inline" id="payForm">
                
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                  
                  <button type="button" class="btn btn-warning btn-sm btn-flat" id="list"><span class="glyphicon glyphicon-print"></span> List</button>
                   <button type="button" class="btn btn-primary btn-sm btn-flat" id="records"><span class="glyphicon glyphicon-print"></span> Records</button> 
                </form>
              </div> 
            </div>-->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Invoice Number</th>
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>INTEG-INS</th>
                  <th>W/TAX</th>  
                  <th>PAG-IBIG</th>   
                  <th>PHILHEALTH</th>   
                  <th>Loan Type</th>   
                  <th>Loan Amount</th>   
                  <th>Status</th>                 
                  <th>Tools</th>
                
                </thead>
                <tbody>
                  <?php
                       
                    
                    /*$to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }*/

                    $sqld ="SELECT * FROM payslip
                  
                    GROUP BY 
                      employee_name ASC";

                    $query = $conn->query($sqld);
                    
                    while($row = $query->fetch_assoc()){
                      
                     if($row['deduction_status']=="Pending"){
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
                          <td>".$row['gsis_total']."</td>
                          <td>".$row['w_tax_total']."</td>
                          <td>".$row['eep']."</td>                        
                          <td>".$row['eeph']."</td>
                          <td>".$row['loan_description']."</td>
                          <td>".$row['loan_amount']."</td>
                          <td>".$check."</td>
                          
                          
                          <td>
                            <a href='#edit' data-toggle='modal' class='btn btn-success btn-sm btn-flat' data-id='".$row['id']."' onclick='getRow(".$row['id'].")'><i class='fa fa-edit'></i> Edit</a>
                            
                            <a   class='btn btn-primary btn-sm btn-flat' id='".$row['invoice_id']."' onclick='redirectToPage2(this)'><i class='fa fa-eye'></i> View</a>
                          </td>
                          
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
              <!-- <a href='#delete' data-toggle='modal' class='btn btn-danger btn-sm btn-flat' data-id='".$row['id']."' onclick='getRow(".$row['id'].")'><i class='fa fa-trash'></i> Delete</a> -->
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/benefits_modal.php'; ?>
  <?php include 'includes/deductions_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?> 
<script>

function redirectToPage2(tdElement) {
            var tdId = tdElement.id;
            var nextPageURL = "my_benefits?id=" + encodeURIComponent(tdId);
            
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
      $('#edit_status').val(response.deduction_status); 
    }
  });
}


</script>
</body>
</html>
