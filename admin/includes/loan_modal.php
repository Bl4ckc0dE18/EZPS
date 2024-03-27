<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add LOAN</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="loan_add.php">
          		  <div class="form-group">
                    <label for="employee_id" class="col-sm-3 control-label">Employee ID</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="employee_id" id="employee_id">
                        
                        <?php
                          $sql = "SELECT * FROM employees";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['employee_id']."'>".$prow['employee_id']."</option>";
                          }
                        ?> 
                      </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="loanamount" class="col-sm-3 control-label">Loan Amount</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="loanamount" name="loanamount" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="monthstopay" class="col-sm-3 control-label">Months To Pay</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="monthstopay" name="monthstopay" required>
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
            	<h4 class="modal-title"><b>Update LOAN</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="loan_edit.php">
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
                    <label for="edit_er" class="col-sm-3 control-label">ER</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_er" name="er" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="edit_ee" class="col-sm-3 control-label">EE</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_ee" name="ee" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="edit_total" class="col-sm-3 control-label">Total</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_total" name="total" required>
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
            	<form class="form-horizontal" method="POST" action="loan_delete.php">
            		<input type="hidden" class="decid" name="id">
            		<div class="text-center">
	                	<p>DELETE LOAN</p>
	                	<h2 id="loanname" class="bold"></h2>
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


     