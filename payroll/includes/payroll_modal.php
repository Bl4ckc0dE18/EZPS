<!-- pay -->
<div class="modal fade" id="pay">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Payroll</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="payroll_pay.php" id="paysForm">	
				<div class="form-group">
                    <label for="select_year" class="col-sm-3 control-label" >Year </label>
						<div class="col-sm-9">
							<select class="form-control input-sm"  name="select_year" id="select_year">
							<?php
								for($i=2015; $i<=2065; $i++){
								$selected = ($i==$year)?'selected':'';
								echo "
									<option value='".$i."' ".$selected.">".$i."</option>
								";
								}
							?>
							</select>
						</div>
				</div>
				<div class="form-group">
                    <label for="select_month" class="col-sm-3 control-label" >Month </label>
						<div class="col-sm-9">
							<select class="form-control input-sm" name="select_month" id="select_month">
								
								<option value="01">JAN</option>
								<option value="02">FEB</option>
								<option value="03">MAR</option>
								<option value="04">APR</option>
								<option value="05">MAY</option>
								<option value="06">JUN</option>
								<option value="07">JUL</option>
								<option value="08">AUG</option>
								<option value="09">SEP</option>
								<option value="10">OCT</option>
								<option value="11">NOV</option>
								<option value="12">DEC</option>
							</select>
						</div>
                  </div>
	
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="pays" id="pays"><i class="fa fa-peso">₱ </i> Generate</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
<!-- generate -->
<div class="modal fade" id="print">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Print</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="payroll_generate.php">	
				<div class="form-group">
                    <label for="select_year" class="col-sm-3 control-label" >Year </label>
						<div class="col-sm-9">
							<select class="form-control input-sm"  name="select_year" id="select_year">
							<?php
								for($i=2015; $i<=2065; $i++){
								$selected = ($i==$year)?'selected':'';
								echo "
									<option value='".$i."' ".$selected.">".$i."</option>
								";
								}
							?>
							</select>
						</div>
				</div>
				<div class="form-group">
                    <label for="select_month" class="col-sm-3 control-label" >Month </label>
						<div class="col-sm-9">
							<select class="form-control input-sm" name="select_month" id="select_month">
								
								<option value="01">JAN</option>
								<option value="02">FEB</option>
								<option value="03">MAR</option>
								<option value="04">APR</option>
								<option value="05">MAY</option>
								<option value="06">JUN</option>
								<option value="07">JUL</option>
								<option value="08">AUG</option>
								<option value="09">SEP</option>
								<option value="10">OCT</option>
								<option value="11">NOV</option>
								<option value="12">DEC</option>
							</select>
						</div>
                  </div>
	
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="print"><i class="fa fa-print"></i> Print</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Update Payment</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="payroll_edit.php">
            		<input type="hidden" class="decid" name="id">
                <div class="form-group">
                    <label for="edit_status" class="col-sm-3 control-label" >Status</label >

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_status" name="status" disabled >
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_payment_status" class="col-sm-3 control-label">Change</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="payment_status" id="edit_payment_status">
                      <option selected id="payment_status">Pending</option>
                      <option selected id="payment_status">Paid</option>
                        
                      </select>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="payroll_delete.php">
            		<input type="hidden" class="decid" name="id">
            		<div class="text-center">
	                	<p>DELETE RECORD</p>
	                	<h2 id="del_payroll" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<script>


// MODAL
$(function(){
		$('#pays').click(function(e){
  e.preventDefault();

  $('#pays').prop('disabled', true); // Disable the button

  showConsoleLogMessage('Please wait while the <br>payroll is being calculating');

});
});
</script>


     