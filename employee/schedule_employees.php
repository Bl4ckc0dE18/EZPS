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
        Employee Schedules Print
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
            
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Employee No</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Work Schedule</th>
                  <th>Work Overtime</th>
                  
                  <th>Tools</th>
                 
                </thead>
                <tbody>
                <?php
                 $look=$user['employee_id'];
                                        // SQL query
                                        $sql = "SELECT 
                                        employees.*, 
                                        employees.id AS empid, 
                                        position.*, 
                                        (SELECT GROUP_CONCAT(CONCAT(schedule_load, ' ', time_load) ORDER BY FIELD(schedule_load, 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'), time_load SEPARATOR ' \n <br>') FROM work_overtime WHERE work_overtime.employee_id = employees.employee_id) AS work_overtimes,
                                        (SELECT GROUP_CONCAT(CONCAT(schedule_day, ' ', TIME_FORMAT(time_in, '%h:%i %p'), ' - ', TIME_FORMAT(time_out, '%h:%i %p'),'<br>TYPE - ',type,'<br>') ORDER BY FIELD(schedule_day, 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT')SEPARATOR ' \n <br>') FROM employee_schedule WHERE employee_schedule.employee_id = employees.employee_id) AS work_schedules
                                    FROM 
                                        employees
                                    LEFT JOIN 
                                        position ON position.id = employees.position_id
                                    WHERE 
                                        employee_id like '$look'
                                    ORDER BY 
                                    work_overtimes,
                                        work_schedules;";


                                        // Execute the query
                                        $query = $conn->query($sql);

                                        // Check for errors
                                        if (!$query) {
                                            // Query failed
                                            echo "Error: " . $conn->error;
                                        } else {
                                            // Query succeeded
                                            // Fetch and display data
                                            while ($row = $query->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['employee_id']; ?></td>
                                                    <td>
                                                        <!-- Adjust this part according to your photo field -->
                                                        <img src="<?php echo (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/profile.jpg'; ?>" width="30px" height="30px">
                                                        <!-- Assuming you have an edit photo modal -->
                                                       
                                                    </td>
                                                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                    <td><?php echo $row['work_schedules']; ?></td>
                                                    <td><?php echo $row['work_overtimes']; ?></td>
                                                    
                                                    <td>
                                                       
                                                        
                                                      
                                                        <button class="btn btn-success btn-sm btn-flat" id="<?php echo $row['employee_id']; ?>" onclick='redirectToPage2(this)'><i class='fa fa-print'></i> Print</button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
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
function redirectToPagePrint(button) {
        window.open('schedule_print', '_blank');
    }
function redirectToPage2(tdElement) {
            var tdId = tdElement.id;
            var nextPageURL = "schedule_print_employee?id=" + encodeURIComponent(tdId);
            
            window.open(nextPageURL, '_blank');
        }
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
      $('#schedule_days').val(response.schedule_day).html(response.schedule_day);
     
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
