<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Employee</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_add.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">Firstname</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>

                    
                    <label for="employee_id" class="col-sm-2 control-label">Employee ID</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="employee_id" name="employee_id" readonly placeholder="Automated">
                    </div>
                                        

                   
                </div>

                <div class="form-group">
                  	

                    <label for="lastname" class="col-sm-2 control-label">Lastname</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>

                    <label for="employee_rfid" class="col-sm-2 control-label">Employee RFID</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="employee_rfid" name="employee_rfid">
                    </div>

                   
                </div>
                <div class="form-group">
                  <label for="hour" class="col-sm-2 control-label">Required Hour</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="hour" name="hour">
                  </div> 

                  <label for="datepicker_add" class="col-sm-2 control-label">Birthdate</label>

                  	<div class="col-sm-4"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="birthdate">
                      </div>
                  	</div>
                </div>

                <div class="form-group">
                  	<label for="address" class="col-sm-2 control-label">Address</label>

                  	<div class="col-sm-4">
                      <!-- <input type="text" class="form-control" id="address" name="address" required> -->
                      <textarea class="form-control" name="address" id="address" style="resize: none;"></textarea>

                  	</div>

                    <label for="photo" class="col-sm-2 control-label">Photo</label>

                    <div class="col-sm-4">
                      <input type="file" name="photo" id="photo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-2 control-label">Contact Info</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="contact" name="contact">
                    </div>


                    <label for="gender" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-4"> 
                      <select class="form-control" name="gender" id="gender" required>
                        <option value="" selected>- Select -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="email" name="email">
                    </div>

                    <label for="contact" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-4">
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <!--  -->
                <div class="form-group">
                    <label for="position" class="col-sm-2 control-label">Position Code</label>

                    <div class="col-sm-4">
                      <select class="form-control" name="position" id="position" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['position_code']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                    <label for="gender" class="col-sm-2 control-label">Day Off</label>

                      <div class="col-sm-4"> 
                        <select class="form-control" name="dayoff" id="dayoff" required>
                          <option value="" selected>- Select -</option>
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
               
                  <label for="regular" class="col-sm-2 control-label">Regular</label>
                    <div class="col-sm-4"> 
                        <select class="form-control" name="regular" id="regular" required>
                          <option value="" selected>- Select -</option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                
                    

                    <label for="eleave" class="col-sm-2 control-label">Leave Day</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="eleave" name="eleave">
                    </div>
                </div>
                <div class="form-group">
                    
                </div>
                <div class="form-group">
                    <label for="datepicker_employee_sadd" class="col-sm-2 control-label">Date of Start Contract</label>

                    <div class="col-sm-4"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_employee_sadd" name="datepicker_employee_sadd" required>
                      </div>
                    </div>

                    <label for="datepicker_employee_add" class="col-sm-2 control-label">Date of end contract</label>

                    <div class="col-sm-4"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_employee_add" name="datepicker_employee_add" required>
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
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	
              <h4 class="modal-title"><b>Added by <span class="admin"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_edit.php">
            		<input type="hidden" class="empid" name="id">

                <div class="form-group">
                    <label for="edit_firstname" class="col-sm-2 control-label">Firstname</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname">
                    </div>
               
                    <label for="edit_employee_id" class="col-sm-2 control-label">Employee ID</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="edit_employee_id" name="employee_id" readonly>
                    </div>

                </div>

                <div class="form-group">
                <label for="edit_lastname" class="col-sm-2 control-label">Lastname</label>

                <div class="col-sm-4">
                  <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                </div>

                    <label for="edit_employee_rfid" class="col-sm-2 control-label">Employee RFID</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="edit_employee_rfid" name="employee_rfid">
                    </div>
                </div>

                
                <div class="form-group">
                    <label for="edit_hour" class="col-sm-2 control-label">Required Hour</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="edit_hour" name="edit_hour">
                    </div> 

                    <label for="datepicker_edit" class="col-sm-2 control-label">Birthdate</label>

                    <div class="col-sm-4"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="birthdate">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-4">
                      <textarea class="form-control" name="address" id="edit_address"  style="resize: none;"></textarea>
                    </div>

                    <label for="contact" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="edit_email" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_contact" class="col-sm-2 control-label">Contact Info</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="edit_contact" name="contact">
                    </div>

                    <label for="edit_gender" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-4"> 
                      <select class="form-control" name="gender" id="edit_gender">
                        <option selected id="gender_val"></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>

                </div>
                <!--  -->
                <!--  -->
                <div class="form-group">
                    <label for="edit_position" class="col-sm-2 control-label">Position Code</label>

                    <div class="col-sm-4">
                      <select class="form-control" name="position" id="edit_position">
                        <option selected id="position_val"></option>
                        <?php
                          $sql = "SELECT * FROM position";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['position_code']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                    <label for="dayoff_edit" class="col-sm-2 control-label">Day Off</label>

                    <div class="col-sm-4"> 
                      <select class="form-control" name="dayoff_edit" id="dayoff_edit" required>
                        <option selected id="dayoff_val"></option>
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
              

                <label for="edit_regular" class="col-sm-2 control-label">Regular</label>
                    <div class="col-sm-4"> 
                        <select class="form-control" name="edit_regular" id="edit_regular" required>
                        <option selected id="regular_val"></option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    <label for="edit_eleave" class="col-sm-2 control-label">Leave Day</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="edit_eleave" name="eleave">
                    </div>
                    
                </div>

                <div class="form-group">
                <label for="datepicker_employee_sedit" class="col-sm-2 control-label">Date of Start Contract</label>

                    <div class="col-sm-4"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_employee_sedit" name="datepicker_employee_sedit" required>
                      </div>
                    </div>

                    <label for="datepicker_employee_edit" class="col-sm-2 control-label">Date of End Contract</label>

                    <div class="col-sm-4"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_employee_edit" name="datepicker_employee_edit" required >
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
            	<!-- <h4 class="modal-title"><b><span class="employee_id"></span></b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_delete.php">
            		<input type="hidden" class="empid" name="id">
            		<div class="text-center">
	                	<p>DELETE EMPLOYEE</p>
	                	<h2 class="bold del_employee_name"></h2>
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

<!-- Password -->
<div class="modal fade" id="edit_employee_password">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<!-- <h4 class="modal-title"><b><span class="employee_id"></span></b></h4> -->
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_password.php">
            		<input type="hidden" class="empid" name="id">
            		<div class="text-center">
	                	<p>UPDATE EMPLOYEE PASSWORD</p>
	                	<h2 class="bold del_employee_name"></h2>

                    <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="edit_password" name="password">
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

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>    

<!-- <script>
  function checkRegularAndSubmit() {
    var regularSelect = document.getElementById('edit_regular');
    var datepickerEndContract = document.getElementById('datepicker_employee_edit');
    var form = document.querySelector('form');
    var submitButton = document.querySelector('[name="edit"]');

    regularSelect.addEventListener('change', function() {
      if (regularSelect.value === 'YES') {
        datepickerEndContract.disabled = true;
        datepickerEndContract.value = '';
      } else {
        datepickerEndContract.disabled = false;
        datepickerEndContract.required = true;
      }
    });

    submitButton.addEventListener('click', function(event) {
      if (regularSelect.value === 'NO' && datepickerEndContract.value === '') {
        event.preventDefault();
        alert('Please fill in the Date of End Contract field.');
      } else {
        // If validation passes, you can submit the form
        form.submit();
      }
    });
  }

  // Call the function to enable/disable the datepicker based on the 'Regular' select option
  checkRegularAndSubmit();
</script> -->
