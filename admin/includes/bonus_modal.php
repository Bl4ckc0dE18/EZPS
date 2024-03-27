<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Bonus</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="bonus_add.php">
          		  <div class="form-group">
                  	<label for="employee" class="col-sm-3 control-label">Employee ID</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="employee" name="employee" required>
                  	</div>
                </div>
				
				<div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">Amount</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                </div>
	
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Update PAG-IBIG</b></h4>
				
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="bonus_edit.php">
              <input type="hidden" class="decid" name="id">

				<div class="form-group">
						<label for="edit_description" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_description" name="description" required>
						</div>
					</div>

					<div class="form-group">
						<label for="edit_amount" class="col-sm-3 control-label">Amount</label>
						<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_amount" name="amount" required>
						</div>
					</div>
					<div class="form-group">
						<label for="edit_status" class="col-sm-3 control-label">Status</label>
						<div class="col-sm-9">
						<input type="text" class="form-control" id="edit_status" name="status" required disabled>
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
            	<form class="form-horizontal" method="POST" action="bonus_delete.php">
            		<input type="hidden" class="decid" name="id">
            		<div class="text-center">
	                	<p>DELETE BONUS</p>
	                	<h2 id="delete_bonus" class="bold" name="id"></h2>
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


     