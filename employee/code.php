
<?php include 'includes/header.php'; 
?>

<body class="hold-transition  login-page">
<div class="login-box ">
  	<div class="login-logo">
  		<b>EZPS EMPLOYEE</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Create new password</p>

    	<form action="forgot_password_edit.php" method="POST">
            <div class="form-group ">
        		<input type="text" class="form-control" name="employee_code" placeholder="Code" required autofocus>
        		<span class="form-control-feedback"> <b>#</b></span>
      		</div>

      		<div class="form-group ">
        		<input type="text" class="form-control" name="employee_id" placeholder="Employee ID" required autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group ">
            <input type="password" class="form-control" name="employee_password" placeholder="New Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			
          </div>
		  
      		<div class="row">
    			<!-- <div class="col-xs-4"> -->
                <div class="pull-right col-xs-12">
          			<button type="submit" class="btn btn-success btn-block btn-flat" name="edit_passowrd"><i class="fa fa-sign-in"></i>  Submit</button>
        		</div>
      		</div>
    	</form>
  	</div>
      <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
        <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
      </div>

      <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
        <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
      </div>

</div>
<?php include 'includes/forgot_password_modal.php'; ?>
<?php include 'includes/scripts.php' ?>

<script>
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
