<?php include 'includes/session.php'; ?>
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
        <li class="active">Deductions</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
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
                    $look=$user['employee_id'];
                    $sql = "SELECT * FROM leave_record WHERE employee_id like '$look' ";
                   
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
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
                            
";
                            if($row['leave_status']=="Approved"){
                              echo"<button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'disabled=false;><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."' disabled=false;><i class='fa fa-trash'></i> Delete</button>";
                            }else{
                              echo"
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."' ><i class='fa fa-trash'></i> Delete</button>
  
                           "; }"
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
    url: 'leave_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.decid').val(response.id);
      $('#id').html(response.id);
      $('#edit_reason').val(response.reason);
      $('#leave_id').html(response.id);
      $('#datepicker_edit_from').val(response.datefrom);
      $('#datepicker_edit_to').val(response.dateto);
   
    }
  });
}
</script>
</body>
</html>
