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
        Loan Records
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
            
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <th>Employee ID</th>
                  <th>Employee Name</th>
                  <th>Description</th>
                  <th>Loan Amount</th>
                  <th>Months To Pay</th>
                  <th>Per Months</th>
                  
                  <th>Loan Paid</th>
                  <th>Loan Balance</th>
                  
                 
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
                   
                    $sqld = "SELECT * FROM loan WHERE employee_id like '$look' ";

                    $query = $conn->query($sqld);
                    //$status = ($row['paystatus'])?'<span class="label label-danger pull-right">Paid</span>':'<span class="label label-warning pull-right">Pending</span>';
                    
                    while($row = $query->fetch_assoc()){
                      
                     

                      echo "
                        <tr>
                         
                        <td>".$row['employee_id']."</td> 
                        <td>".$row['employee_name']."</td>     
                        <td>".$row['description']."</td>
                        <td>".number_format($row['loanamount'], 2)."</td>
                        <td>".$row['monthstopay']."</td>
                        <td>".number_format($row['permonths'], 2)."</td>
                        
                        <td>".number_format($row['loanpay'], 2)."</td>
                        <td>".number_format($row['loanbalance'], 2)."</td>
                          
                          
                         
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
    
  <?php include 'includes/footer.php'; ?>

</div>
<?php include 'includes/scripts.php'; ?> 
<script>
function redirectToPage2(tdElement) {
            // Get the ID attribute of the clicked <td> element
            var tdId = tdElement.id;

            // Construct the URL for the next PHP page with the ID as a query parameter
            var nextPageURL = "my_benefits.php?id=" + encodeURIComponent(tdId);

            // Redirect to the next PHP page
            window.location.href = nextPageURL;
        }
$(function(){

  $('#benefits_record').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'my_loan_record.php');
    $('#payForm').submit();
  });


});


</script>
</body>
</html>
