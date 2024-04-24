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
        Schedules
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Schedules</li>
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
            <!-- <div class="box-header with-border">
              <a href="schedule_print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
            </div> -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <th>Date</th>
                  <th>Time</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out']))."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['empid']."'><i class='fa fa-edit'></i> Edit</button>
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
  <?php include 'includes/audit_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.view').click(function(e){
    e.preventDefault();
    $('#view').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'audit_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userby').html(response.user);
      
      $('#audit_description').val(response.description);
      $('#empid').val(response.empid);
      $('.empid').val(response.empid);


    var auditDate = moment(response.audit_date).format('MMM D, YYYY');
   $('.audit_date').html(auditDate);
   var formattedTime = moment(response.audit_time, "H:mm:ss A").format("h:mm:ss A");
    $('.audit_time').html(formattedTime);
    }
  });
}
</script>
</body>
</html>
