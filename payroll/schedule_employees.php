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
        Employee Schedules
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
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Employee No</th>
                  <th>Name</th>
                  <th>Day</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Tools</th>
                 
                </thead>
                <tbody>
                  <?php
                   $sql = "SELECT employee_id,name,GROUP_CONCAT(id) AS ids,
                   GROUP_CONCAT(schedule_day) AS schedule_days, 
                   GROUP_CONCAT(time_in) AS time_ins, 
                   GROUP_CONCAT(time_out) AS time_outs
                    FROM employee_schedule 
                    GROUP BY employee_id";
                   // $sql = "SELECT * FROM employee_schedule";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){

                      $ids = explode(',', $row['ids']);
                      $schedule_days = explode(',', $row['schedule_days']);
                      $time_ins = explode(',', $row['time_ins']);
                      $time_outs = explode(',', $row['time_outs']);
                      echo "
                        <tr>
                        <td>".$row['employee_id']."</td>
                        <td>".$row['name']."<td>";
                        foreach ($schedule_days as $index => $schedule_day) {
                          echo $schedule_day;
                          if ($index < count($schedule_days) - 1) {
                              echo "<br>";
                              
                          }
                      }
                      echo "<td>";
                            foreach ($time_ins as $index => $time_in) {
                              $formatted_time_in = date('h:i A', strtotime($time_in));
                              echo $formatted_time_in;
                              if ($index < count($time_ins) - 1) {
                                  echo "<br>";
                              }
                          }
                      echo "<td>";
                          foreach ($time_outs as $index => $time_out) {
                            $formatted_time_out = date('h:i A', strtotime($time_out));
                            echo $formatted_time_out."<a href='#edit_schedule' data-toggle='modal' class='pull-right' data-id='$ids[$index]'onclick='getRow(".$ids[$index].")'><span class='fa fa-edit'></span></a> ";
                            if ($index < count($time_outs) - 1) {
                                echo "<br>";
                            }
                      }    
                      echo "</td>
                            <td>                       
                                <a href='#print' data-toggle='modal' class='btn btn-primary btn-sm btn-flat' data-id='".$row['employee_id']."' onclick='getRow(".$row['employee_id'].")'><i class='fa fa-print'></i> Print</a>                               
                                <a href='#delete' data-toggle='modal' class='btn btn-danger btn-sm btn-flat' data-id='".$row['employee_id']."' onclick='getRow(".$row['employee_id'].")'><i class='fa fa-trash'></i> Delete</a>               
                                
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
  <?php include 'includes/schedule_employees_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit_schedule').click(function(e){
    e.preventDefault();
    $('#edit_schedule').modal('show');
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
    url: 'schedule_employees_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      //edit
      $('#timeid').val(response.id);
      $('#employee_id_edit').html(response.employee_id);
      $('#employee_name_edit').html(response.name);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#del_timeid').val(response.id);
      //delete
      $('#del_schedule').html(response.name);
      $('#employee_id_delete').val(response.employee_id);
      //print
      $('#print_schedule').html(response.name);
    }
  });
}
</script>
</body>
</html>
