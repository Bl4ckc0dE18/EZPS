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
        Employee Work Load Schedules
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
                  <th>Load</th>
                  <th>Tools</th>               
                </thead>
                <tbody>
                  <?php
                  // $sql = "SELECT * FROM work_load";
                   $sql = "SELECT employee_id,name,
                   GROUP_CONCAT(id) AS ids,
                   GROUP_CONCAT(schedule_load) AS schedule_loads, 
                   GROUP_CONCAT(time_load) AS time_loads 
                    FROM work_load 
                    GROUP BY employee_id";

                    
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                        $ids = explode(',', $row['ids']);
                        $schedule_loads = explode(',', $row['schedule_loads']);
                       
                        $time_loads = explode(',', $row['time_loads']);
                        echo "
                          <tr>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['name']."<td>";
                          foreach ($schedule_loads as $index => $schedule_load) {
                            echo $schedule_load;
                            if ($index < count($schedule_loads) - 1) {
                                echo "<br>";
                                
                            }
                        }
                        echo "<td>";
                            foreach ($time_loads as $index => $time_load) {
                             
                              echo $time_load."<a href='#edit_schedule' data-toggle='modal' class='pull-right' data-id='$ids[$index]'onclick='getRow(".$ids[$index].")'><span class='fa fa-edit'></span></a> ";
                              if ($index < count($time_loads) - 1) {
                                  echo "<br>";
                              }
                        }    
                        echo "</td>
                              <td>                       
                                 
                                  <a href='#delete' data-toggle='modal' class='btn btn-danger btn-sm btn-flat' data-id='".$row['employee_id']."' onclick='getRow(".$row['employee_id'].")'><i class='fa fa-trash'></i> Delete</a>               
                                  
                              </td>
                          </tr>
                          ";
                    








                      /*echo "
                        <tr>
                            <td>".$row['employee_id']."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['schedule_load']."</td>
                            <td>".$row['time_load']."</td> 
                        
                            <td>                       
                               
                                <a href='#delete' data-toggle='modal' class='btn btn-danger btn-sm btn-flat' data-id='".$row['employee_id']."' onclick='getRow(".$row['employee_id'].")'><i class='fa fa-trash'></i> Delete</a>               
                                
                            </td>
                        </tr>
                        ";*/


                          
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
  <?php include 'includes/work_load_modal.php'; ?>
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
