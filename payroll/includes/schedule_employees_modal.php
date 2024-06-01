<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Schedule</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="schedule_employees_add.php">

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
                    <label for="schedule_day" class="col-sm-3 control-label">Schedule Day</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="schedule_day" id="schedule_day">
                       
                        <option value="SUN">SUN</option>
                        <option value="MON">MON</option>
                        <option value="TUE">TUE</option>
                        <option value="WED">WED</option>
                        <option value="THU">THU</option>
						<option value="FRI">FRI</option>
						<option value="SAT">SAT</option>
                      </select>
                    </div>
                </div>
				<div class="form-group">
                    <label for="schedule_type" class="col-sm-3 control-label">Schedule Type</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="schedule_type" id="schedule_type">
                       
                        <option value="FTE">FTE</option>
                        <option value="WL">WL</option>
                       
                      </select>
                    </div>
                </div>
          		  <div class="form-group">
                  	<label for="time_in" class="col-sm-3 control-label">Time In</label>

                  	<div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                    	 <input type="text" class="form-control timepicker" id="time_in" name="time_in" required>
                      </div>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="time_out" class="col-sm-3 control-label">Time Out</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="time_out" name="time_out" required>
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
<div class="modal fade" id="edit_schedule">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title timeid"><b>Update Schedule</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="schedule_employees_edit_delete.php">
            		<input type="hidden" id="timeid" name="id">
					
					
					<div class="form-group">
                    		<label for="schedule_day" class="col-sm-3 control-label">Employee ID</label>
						<div class="col-sm-9">
							<label class="control-label" id="employee_id_edit" name="employee_id_edit"></label>
						</div>
                	</div>

					<div class="form-group">
                    		<label for="employee_name_edit" class="col-sm-3 control-label">Employee Name</label>
						<div class="col-sm-9">
							<label class=" control-label" id="employee_name_edit" name="employee_name_edit"	></label>
						</div>
                	</div>

					<div class="form-group">
                    	<label for="schedule_day_edit" class="col-sm-3 control-label">Schedule Day</label>
							<div class="col-sm-9">
							<select class="form-control" name="schedule_day_edit" id="schedule_day_edit">
								<option selected id="schedule_days"></option>
								<option value="SUN">SUN</option>
								<option value="MON">MON</option>
								<option value="TUE">TUE</option>
								<option value="WED">WED</option>
								<option value="THU">THU</option>
								<option value="FRI">FRI</option>
								<option value="SAT">SAT</option>
							</select>
							</div>
                		</div>	
						<div class="form-group">
							<label for="schedule_type_edit" class="col-sm-3 control-label">Schedule Type</label>
							<div class="col-sm-9">
							<select class="form-control" name="schedule_type_edit" id="schedule_type_edit">
							<option selected id="schedule_types"></option>
								<option value="FTE">FTE</option>
								<option value="WL">WL</option>
							
							</select>
							</div>
						</div>
                <div class="form-group">
                    <label for="edit_time_in" class="col-sm-3 control-label">Time In</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="edit_time_in" name="time_in">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_time_out" class="col-sm-3 control-label">Time out</label>

                    <div class="col-sm-9">
                      <div class="bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" id="edit_time_out" name="time_out">
                      </div>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
				<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
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
            	<form class="form-horizontal" method="POST" action="schedule_employees_delete.php">
            		<input type="hidden" id="del_timeid" name="id">
					<input type="hidden" id="employee_id_delete" name="employee_id_delete">
            		<div class="text-center">
	                	<p>DELETE SCHEDULE</p>
	                	<h2 id="del_schedule" class="bold"></h2>
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

<!-- Print -->
<div class="modal fade" id="print">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Print...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="schedule_delete.php">
            		<input type="hidden" id="del_timeid" name="id">
            		<div class="text-center">
	                	<p>PRINT SCHEDULE</p>
	                	<h2 id="print_schedule" class="bold"></h2>
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


     