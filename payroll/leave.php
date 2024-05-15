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
        Leave Records
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
                  
                  
                 
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  
                 <th>Employee Name</th>
                  <th>Department</th>
                  <th>Reason</th>
                  <th>From</th>   
                  <th>To</th>   
                  <th>Status</th>                 
                  <th>Comment</th>
                  <th>Applied On</th>
                  <th>Tools</th>
                
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM leave_record";
                     $query = $conn->query($sql);

                     
                        // Fetch and display the data
                        while ($row = $query->fetch_assoc()) {
                               if($row['leave_status']=="Pending"){
                                $check = '<span class="label label-warning">Pending</span>' ;
                               }

                               elseif($row['leave_status']=="Approved"){
                                $check = '<span class="label label-success">Approved</span>' ;
                               }
                               else{
                                $check = '<span class="label label-danger">Rejected</span>' ;
                               }
          
                                echo "
                                  <tr>
                                  <td>".$row['employee_name']."</td>
                                  <td>".$row['department']."</td>
                                  <td>".$row['reason']."</td>
                                  <td>".$row['datefrom']."</td>
                                  <td>".$row['dateto']."</td>                        
                                  <td>".$check."</td>
                                  <td>".$row['leave_comment']."</td>
                                  <td>".$row['applied_on']."</td>
                                    
                                    
                                    <td>
                                      <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                                     
                                     
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
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/leave_modal.php'; ?>
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
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  }); 
  $('.view').click(function(e){
    e.preventDefault();
    $('#view').modal('show');
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
    window.location = 'payroll.php?range='+range;
  });

  $('#generate').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'payroll_pay.php');
    $('#payForm').submit();
  });

  $('#list').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'benefits_list_generate.php');
    $('#payForm').submit();
  });

  $('#records').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'benefits_records_generate.php');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'leave_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.decid').val(response.id);
      $('#edit_status').val(response.leave_status);
      $('#edit_comment').val(response.leave_comment);
     
      
      
    }
  });
}


</script>
</body>
</html>
