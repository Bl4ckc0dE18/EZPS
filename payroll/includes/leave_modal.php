<style>
  .imgcenter {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    /* border: solid 3px rgb(0, 0, 0); */
     /* border-radius: 50%;
   background-color: rgba(245, 126, 126, 0.815); */
  }

</style>
<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Update Leave Request</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_edit.php">
            		<input type="hidden" class="decid" name="id">
                <div class="form-group">
                    <label for="edit_status" class="col-sm-3 control-label">Status</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_status" name="status" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit_leave_status" class="col-sm-3 control-label">Change</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="leave_status" id="edit_leave_status">
                      <option selected id="leave_status">Pending</option>
                      <option selected id="leave_status">Approved</option>
                      <option selected id="leave_status">Rejected</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_comment" class="col-sm-3 control-label">Comment</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_comment" name="comment">
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


<!-- View -->
<div class="modal fade" id="view">
    <div class="modal-dialog ">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>View Employee Attendance</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_edit.php">
            		<input type="hidden" class="decid" name="id">
                
              

                <div class="form-group">
                    <img src="../images/attendance.png" alt="RFID" class="imgcenter">
                    
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	
            	</form>
          	</div>
        </div>
    </div>
</div>

