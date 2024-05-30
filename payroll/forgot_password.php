<?php include 'includes/header.php'; ?>

<body class="hold-transition  login-page">
<div class="login-box ">
  	<div class="login-logo">
  		<b>EZ PAYROLL SYSTEM</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Forgot Password</p>

    	<form id="forgotpassword">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" id="username_fp" name="username_fp" placeholder="Username" required autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" id="email_fp" name="email_fp" placeholder="Email" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-12">
          			<button type="submit" class="btn btn-success btn-block btn-flat" name="edit_password"><i class="fa fa-sign-in"></i> Submit</button>
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

<?php include 'includes/scripts.php' ?>

<script type="text/javascript">
$(function() {

  $('#forgotpassword').submit(function(e){
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'forgot_password_edit.php',
      data: formData,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
          setTimeout(function () {
            $('.alert').hide();
            $('#username_fp').val('');
            $('#email_fp').val('');
          }, 1000);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          setTimeout(function () {
            $('.alert').hide();
            $('#username_fp').val('');
            $('#email_fp').val('');
            window.location.href = "verification_code"; // Assuming verification_code.php is the correct URL
          }, 1000);
        }
      }
    });
  });
});
</script>
</body>
</html>
