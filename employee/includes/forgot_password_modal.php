<!-- Forgot -->
<div class="modal fade" id="forgot">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Forgot Password</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="forgot_password_edit.php">
            		<!-- <input type="hidden" class="decid" name="id"> -->
                <div class="form-group">
                    <label for="e_id" class="col-sm-3 control-label" >Employee ID</label >

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="e_id" name="e_id" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="e_email" class="col-sm-3 control-label" >Employee Email</label >

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="e_email" name="e_email" >
                    </div>
                </div>
                
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="generate"><i class="fa fa-check-square-o"></i> Submit</button>
            	</form>
          	</div>
        </div>
    </div>
</div>