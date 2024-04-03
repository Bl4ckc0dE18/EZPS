<!-- View -->
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title">
              <b>Audit by : <span class="userby "></span> <br>
              Date : <span class="audit_date "> </span> <br>
              <span>Time : <span class="audit_time"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="#">
            		<input type="hidden" id="empid" name="id">
                
                <div class="form-group">
                  <label for="audit_description" class="col-sm-2 control-label">Description</label> 
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea class="form-control" id="audit_description" name="audit_description" readonly style="height: 300px;resize:none;"></textarea>
                    </div>
                </div>

               

          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	
            	</form>
          	</div>
        </div>
    </div>
</div>


