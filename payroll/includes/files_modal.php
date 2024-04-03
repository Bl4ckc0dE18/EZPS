<!-- Add -->
<div class="modal fade" id="upload">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Upload Attendance</b></h4>
          	</div>
          	<div class="modal-body">
              <!-- <form class="form-horizontal" method="POST" action="home.php"> -->
            	<form class="form-horizontal" method="POST" action="files_upload.php" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="f_upload" class="col-sm-3 control-label">Select File</label>

                  	<div class="col-sm-9">
                    	<input type="file" class="form-control" id="f_upload" name="f_upload" required>
                  	</div>
                </div>
                
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-upload"></i>  Upload</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
<div class="modal fade" id="download">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Download Attendance</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="files_download.php">
          		  <div class="form-group">
                  	<label for="from" class="col-sm-3 control-label">Date From</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="datepicker_download_from" name="datepicker_download_from" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="to" class="col-sm-3 control-label">Date To</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="datepicker_download_to" name="datepicker_download_to" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-download"></i>  Download</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="biometrics">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Upload Biometrics</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="home.php">
          		  <div class="form-group">
                  	<label for="biometrics" class="col-sm-3 control-label">Select File</label>

                  	<div class="col-sm-9">
                    	<input type="file" class="form-control" id="biometrics" name="biometrics" required>
                  	</div>
                </div>
                
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-upload"></i>  Upload</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


     