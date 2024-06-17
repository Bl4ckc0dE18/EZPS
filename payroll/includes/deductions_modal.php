<!-- Add -->
<div class="modal fade" id="print">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Print</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="deduction_records.php">
          		  <!-- <div class="form-group">
						<label for="department" class="col-sm-3 control-label">Department</label>

						<div class="col-sm-9">
							<select class="form-control" name="department" id="department">  
							<?php
							$sql = "SELECT * FROM department";
							$query = $conn->query($sql);
							while($prow = $query->fetch_assoc()){
								echo "
								<option value='".$prow['code']."'>".$prow['name']."</option>
								";
							}
							?>
							</select>   
						</div>
						
                	</div> -->

					<div class="form-group">
						<label for="employee" class="col-sm-3 control-label">Deduction</label>

						<div class="col-sm-9">
						<select class="form-control" name="description" id="description">                       
							<option value="Disallowance">Disallowance</option>
							<option value="Ref-Sal">Ref-Sal</option>
							<option value="Ref-Ocom">Ref-Ocom</option>
							<option value="NHMC">NHMC</option>
							<option value="MP2">MP2</option>
							<option value="Integ-Ins">Integ-Ins</option>
							<option value="W/tax">W/tax</option>
							<option value="Philhealth">Philhealth</option>
							<option value="GSIS MPL">GSIS MPL</option>
							<option value="GSIS Sal">GSIS Sal</option>
							<option value="GSIS Pol">GSIS Pol</option>
							<option value="GSIS ELA">GSIS ELA</option>
							<option value="GSIS Opin">GSIS Opin</option>
							<option value="GSIS OpLo">GSIS OpLo</option>
							<option value="GSIS GFAL">GSIS GFAL</option>
							<option value="GSIS HIP">GSIS HIP</option>
							<option value="GSIS CPL">GSIS CPL</option>
							<option value="GSIS SOS">GSIS SOS</option>
							<option value="GSIS Eplan">GSIS Eplan</option>
							<option value="GSIS Ecard">GSIS Ecard</option>
							<option value="HDMF MPL">HDMF MPL</option>
							<option value="HDMF Res">HDMF Res</option>
							<option value="HDMF Con">HDMF Con</option>
							<option value="LBP">LBP</option>
							<option value="TUPM-Cd">TUPM-Cd</option>
							<option value="Fin Ass">Fin Ass</option>
							<option value="GSIS Educ">GSIS Educ</option>
							<option value="TUPAEA">TUPAEA</option>
							<option value="TUPFA">TUPFA</option>
							<option value="HDMF Eme">HDMF Eme</option>


                      </select>
						</div>
                	</div>
				<div class="form-group">
                    <label for="select_year" class="col-sm-3 control-label" >Year </label>
						<div class="col-sm-9">
							<select class="form-control input-sm"  name="select_year" id="select_year">
							<?php
								for($i=2015; $i<=2065; $i++){
								$selected = ($i==$year)?'selected':'';
								echo "
									<option value='".$i."' ".$selected.">".$i."</option>
								";
								}
							?>
							</select>
						</div>
				</div>
				<div class="form-group">
                    <label for="select_month" class="col-sm-3 control-label" >Month </label>
						<div class="col-sm-9">
							<select class="form-control input-sm" name="select_month" id="select_month">
								<option value="" selected>- Select -</option>
								<option value="01">JAN</option>
								<option value="02">FEB</option>
								<option value="03">MAR</option>
								<option value="04">APR</option>
								<option value="05">MAY</option>
								<option value="06">JUN</option>
								<option value="07">JUL</option>
								<option value="08">AUG</option>
								<option value="09">SEP</option>
								<option value="10">OCT</option>
								<option value="11">NOV</option>
								<option value="12">DEC</option>
							</select>
						</div>
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

