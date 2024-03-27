<!-- Edit -->
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Date and Time Record </span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="my_dtr.php">
            	<input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="edit_employee_id" class="col-sm-3 control-label">Employee ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_employee_id" name="employee_id" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="employee_name" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="employee_name" name="employee_name" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="from" class="col-sm-3 control-label">From</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_dtr_from" name="datepicker_dtr_from" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="to" class="col-sm-3 control-label">To</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_dtr_to" name="datepicker_dtr_to" required>
                      </div>
                    </div>
                </div>

               

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="view"><i class="fa fa-eye"></i> View</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


