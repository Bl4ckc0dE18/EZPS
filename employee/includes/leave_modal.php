<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Leave</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_add.php">
          		  <div class="form-group">
                  	<label for="reason" class="col-sm-3 control-label">Reason</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="reason" name="reason" required>
                  	</div>
                </div>

                <div class="form-group">
                    <label for="from" class="col-sm-3 control-label">Date From</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add_from" name="datefrom" required>
                      </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="to" class="col-sm-3 control-label">Date To</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add_to" name="dateto" required>
                      </div>
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
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Update Leave</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_edit.php">
            		<input type="hidden" class="decid" name="id">

                <div class="form-group">
                  	<label for="edit_reason" class="col-sm-3 control-label">Reason</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_reason" name="reason" required>
                  	</div>
                </div>
                
                <div class="form-group">
                    <label for="edit_from" class="col-sm-3 control-label">Date From</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit_from" name="datefrom" required>
                      </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_to" class="col-sm-3 control-label">Date To</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit_to" name="dateto" required>
                      </div>
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
            	<form class="form-horizontal" method="POST" action="leave_delete.php">
            		<input type="hidden" class="decid" name="id">
            		<div class="text-center">
	                	<p>DELETE LEAVE</p>
	                	<h2 id="leave_id" class="bold"></h2>
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

     