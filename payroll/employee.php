<?php
include 'includes/session.php';
include 'includes/header.php';
?>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <?php
        include 'includes/navbar.php';
        include 'includes/menubar.php';
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Employee List</h1>
            </section>
            <section class="content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        " . $_SESSION['error'] . "
                    </div>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        " . $_SESSION['success'] . "
                    </div>";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Work Schedule</th>
                                            <th>Work Load</th>
                                            <th>Member Since</th>
                                            <th>Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // SQL query 
                                        $sql = "SELECT 
                                        employees.*, 
                                        employees.id AS empid, 
                                        position.*, 
                                        (SELECT GROUP_CONCAT(CONCAT(schedule_load, ' ', time_load) ORDER BY FIELD(schedule_load, 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'), time_load SEPARATOR ' \n <br>') FROM work_load WHERE work_load.employee_id = employees.employee_id) AS work_loads,
                                        (SELECT GROUP_CONCAT(CONCAT(schedule_day, ' ', TIME_FORMAT(time_in, '%h:%i %p'), ' - ', TIME_FORMAT(time_out, '%h:%i %p')) ORDER BY FIELD(schedule_day, 'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT')SEPARATOR ' \n <br>') FROM employee_schedule WHERE employee_schedule.employee_id = employees.employee_id) AS work_schedules
                                    FROM 
                                        employees 
                                    LEFT JOIN 
                                        position ON position.id = employees.position_id
                                    ORDER BY 
                                        work_loads,
                                        work_schedules;
                                    ";

                                        // Execute the query
                                        $query = $conn->query($sql);

                                        // Check for errors
                                        if (!$query) {
                                            // Query failed
                                            echo "Error: " . $conn->error;
                                        } else {
                                            // Query succeeded
                                            // Fetch and display data
                                            while ($row = $query->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['employee_id']; ?></td>
                                                    <td>
                                                        <!-- Adjust this part according to your photo field -->
                                                        <img src="<?php echo (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/profile.jpg'; ?>" width="30px" height="30px">
                                                        <!-- Assuming you have an edit photo modal -->
                                                        <a href="#edit_photo" data-toggle="modal" class="pull-right photo" data-id="<?php echo $row['empid']; ?>"><span class="fa fa-edit"></span></a>
                                                    </td>
                                                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                                    <td><?php echo $row['position_code']; ?></td>
                                                    <td><?php echo $row['work_schedules']; ?></td>
                                                    <td><?php echo $row['work_loads']; ?></td>
                                                    <td><?php echo date('M d, Y', strtotime($row['created_on'])) ?></td>
                                                    <td>
                                                       
                                                        
                                                         <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-edit"></i> Edit</button>
                                                        <button class="btn btn-success btn-sm edit_employee_password btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-edit"></i> Password</button><br><br><br>
                                                        <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-trash"></i> Delete</button>
                                                        <button class="btn btn-primary btn-sm btn-flat" id="<?php echo $row['employee_id']; ?>" onclick='redirectToPage2(this)'><i class='fa fa-eye'></i>View ID</button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/employee_modal.php'; ?>
    </div>
    <?php include 'includes/scripts.php'; ?>
    <script>
        function redirectToPage2(tdElement) {
            var tdId = tdElement.id;
            var nextPageURL = "employee_my_id.php?id=" + encodeURIComponent(tdId);
            window.location.href = nextPageURL;
        }

        $(function() {
            $('.edit').click(function(e) {
                e.preventDefault();
                $('#edit').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

            $('.delete').click(function(e) {
                e.preventDefault();
                $('#delete').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });
            $('.edit_employee_password').click(function(e) {
                e.preventDefault();
                $('#edit_employee_password').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });
            $('.photo').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                getRow(id);
            });
        });

        function getRow(id) {
            $.ajax({
                type: 'POST',
                url: 'employee_row.php',
                data: {
                    id: id
                },
                
                dataType: 'json',
                success: function(response) {
                    $('.empid').val(response.empid);
                    $('.admin').html(response.created_by);
                    $('#edit_employee_id').val(response.employee_id);
                    $('#edit_employee_rfid').val(response.employee_rfid);
                    $('.del_employee_name').html(response.firstname + ' ' + response.lastname);
                    $('#employee_name').html(response.firstname + ' ' + response.lastname);
                    $('#edit_firstname').val(response.firstname);
                    $('#edit_lastname').val(response.lastname);
                    $('#edit_hour').val(response.required_hour);
                    $('#edit_address').val(response.address);
                    $('#datepicker_edit').val(response.birthdate);
                    $('#edit_contact').val(response.contact_info);
                    $('#edit_email').val(response.email);
                    $('#edit_password').val(response.password);
                    $('#gender_val').val(response.gender).html(response.gender);
                    $('#position_val').val(response.position_id).html(response.position_code);
                    $('#regular_val').html(response.regular);

                    $('#dayoff_val').html(response.day_off);
                    $('#edit_eleave').val(response.e_leave);
                    $('#datepicker_employee_sedit').val(response.created_on);
                    $('#datepicker_employee_edit').val(response.end_contract);
                }
            });
        }
    </script>
</body>
</html>
