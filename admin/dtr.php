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
        Employee Date and Time Record
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Employee List</li>
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
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                  
                    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN schedules ON schedules.id=employees.schedule_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['employee_id']; ?></td>
                          <td><img src="<?php echo (!empty($row['photo']))? '../images/'.$row['photo']:'../images/profile.jpg'; ?>" width="30px" height="30px"> </a></td>
                          <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                          <td><?php echo $row['description']; ?></td>
                         
                          <td>
                         
                            <button class="btn btn-primary btn-sm view btn-flat" data-id="<?php echo $row['empid']; ?>"><i class='fa fa-eye'></i> View DTR</button>
                          </td>
                        </tr>
                      <?php
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
  <!-- <?php include 'includes/dtr_modal.php'; ?> -->
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
/*
    $("#reservations").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'dtr.php?range='+range;
  });





  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $('.edit_employee_password').click(function(e){
    e.preventDefault();
    $('#edit_employee_password').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});
*/
function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.admin').html(response.created_by);
      $('#edit_employee_id').val(response.employee_id);
      $('#edit_employee_rfid').val(response.employee_rfid);  
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').val(response.firstname+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#gender_val').val(response.gender).html(response.gender);
      $('#position_val').val(response.position_id).html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
      $('#dayoff_edit').val(response.day_off);
      $('#edit_eleave').val(response.e_leave);   
      $('#datepicker_employee_sedit').val(response.created_on);
      $('#datepicker_employee_edit').val(response.end_contract);
      

    }
  });
}
</script>
</body>
</html>
