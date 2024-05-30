
<?php include 'includes/header.php'; ?>

<body class="hold-transition  login-page">
<div class="login-box ">
  	<div class="login-logo">
  		<b>EZPS EMPLOYEE</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Verification Code</p>

    	<form id="verificationcode">

        <div class="form-group has-feedback">
        	<input type="text" class="form-control" id="employee_id_vc" name="employee_id_vc" placeholder="Username" required autofocus>
        	<span class="glyphicon glyphicon-user form-control-feedback"></span>
      	</div>

        <div class="form-group has-feedback">
				  <input type="text" class="form-control" id="email_vc" name="email_vc" placeholder="Email" required>
				  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

		    <div class="form-group has-feedback">
				  <input type="text" class="form-control" id="code_vc" name="code_vc" placeholder="Code" required>
				  <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
        </div>

			  <div class="form-group has-feedback">
          <input type="password" class="form-control" id="password_vc" name="password_vc" placeholder="New Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

      	<div class="row">
    			<div class="col-xs-12">
          		<button type="submit" class="btn btn-success btn-block btn-flat" name="edit_passowrd"><i class="fa fa-sign-in"></i> Submit</button>
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

  $('#verificationcode').submit(function(e){
    e.preventDefault();
    var verificationcode = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'verification_code_edit.php',
      data: verificationcode,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
		      setTimeout(function () {
            $('.alert').hide();
			      /**/$('#employee_id_vc').val('');
			      $('#email_vc').val('');
            $('#code_vc').val('');
            $('#password_vc').val('');

          }, 1000);
			
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
		    setTimeout(function () {
            $('.alert').hide();
           /* */$('#employee_id_vc').val('');
			      $('#email_vc').val('');
            $('#code_vc').val('');
            $('#password_vc').val('');
            window.location.href = "index";
            }, 1000);
        }
      }
    });
  });
    
});
</script>
</body>
</html>