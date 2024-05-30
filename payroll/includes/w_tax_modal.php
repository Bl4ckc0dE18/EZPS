<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Withholding Tax</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="w_tax_add.php">
          		  <div class="form-group">
                  	<label for="from" class="col-sm-3 control-label">From</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="from" name="from" required>
                  	</div>
                </div>

                <div class="form-group">
                    <label for="amount" class="col-sm-3 control-label">To</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="to" name="to" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="a" class="col-sm-3 control-label">A</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="a" name="a" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="b" class="col-sm-3 control-label">B</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="b" name="b" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="c" class="col-sm-3 control-label">C</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="c" name="c" required>
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
            	<h4 class="modal-title"><b>Update Withholding Tax</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="w_tax_edit.php">
              <input type="hidden" class="decid" name="id">
                <div class="form-group">
                    <label for="edit_from" class="col-sm-3 control-label">From</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_from" name="from" required>
                  	</div>
                </div>

                <div class="form-group">
                    <label for="edit_to" class="col-sm-3 control-label">To</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_to" name="to" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_a" class="col-sm-3 control-label">A</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_a" name="a" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="edit_b" class="col-sm-3 control-label">B</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_b" name="b" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="edit_c" class="col-sm-3 control-label">C</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_c" name="c" required>
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
            	<form class="form-horizontal" method="POST" action="w_tax_delete.php">
            		<input type="hidden" class="decid" name="id">
            		<div class="text-center">
	                	<p>DELETE Withholding Tax</p>
	                	<h2 id="w_tax_deduction" class="bold"></h2>
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


     