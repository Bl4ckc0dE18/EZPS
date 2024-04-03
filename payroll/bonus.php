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
        Bonus
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Cash Advance</li>
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
                  
                  <th>Date</th>
                  <th>Invoice Number</th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM employee_bonus";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      if($row['bonus_status']=="Pending"){
                        $check = '<span class="label label-warning">Pending</span>' ;                       
                       }
                       else{
                        $check = '<span class="label label-success">Paid</span>' ;
                       }
                      echo "
                        <tr>
                          <td>".$row['applied_on']."</td>
                          <td>".$row['invoice_id']."</td>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['employee_name']."</td>
                          <td>".$row['description']."</td>
                          <td>".number_format($row['amount'], 2)."</td>
                          <td>".$check."</td>    
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                           
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
  <?php include 'includes/bonus_modal.php'; ?>
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
    url: 'bonus_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      console.log(response);
      $('.id').val(response.id);
      $('#delete_bonus').html(response.invoice_id);
      $('#delete_bonuss').html(response.invoice_id);
      $('.date').html(response.date_advance);
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('.decid').val(response.id);
      
      $('#edit_description').val(response.description);
      $('#edit_amount').val(response.amount);
      $('#edit_status').val(response.bonus_status);
    }
  });
}
</script>
</body>
</html>
