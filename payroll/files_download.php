<?php
include 'includes/session.php';

// Ensure both date parameters are set
if(isset($_POST['datepicker_download_from'], $_POST['datepicker_download_to'])) {
    // Get "from" and "to" dates from parameters
    $fromDate = $_POST['datepicker_download_from'];
    $toDate = $_POST['datepicker_download_to'];

    // Prepare SQL statement with placeholders
    $sql = "SELECT employee_id, date, time_in, status, time_out, num_hr, num_ot ,num_wl
            FROM attendance 
            WHERE date BETWEEN ? AND ?";
    
    // Prepare and bind parameters to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fromDate, $toDate);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Generate CSV file content
        $csvData = "";
        while ($row = $result->fetch_assoc()) {
            $csvData .= $row['employee_id'] . "," . $row['date'] . "," . $row['time_in'] . "," . $row['status'] . "," . $row['time_out'] . "," . $row['num_hr'] . "," . $row['num_ot'] ."," . $row['num_wl'] . "\n";
        }

        // Set headers for file download
        // Set filename dynamically based on date range
        $fromDateFormatted = date('M d Y', strtotime($fromDate));
        $toDateFormatted = date('M d Y', strtotime($toDate));
        $filename = 'attendance-from-' . str_replace('-', '', $fromDateFormatted) . '-to-' . str_replace('-', '', $toDateFormatted) . '.csv';
        header("Content-Disposition: attachment; filename=$filename");
        
        // Output the CSV data
        
        $des = 	$filename;
        $auditdate = date('Y-m-d');
        $audittime = date('H:i:s');
        $audituser = $user['firstname'].' '.$user['lastname'];
        $auditdescription = 'Attendance downloaded '.$des.' date '.$auditdate;

        $sqlaudit = "INSERT INTO audit_trail_record (audit_date,audit_time, user, description) 
        VALUES ('$auditdate', '$audittime', '$audituser', '$auditdescription')";
        if ($conn->query($sqlaudit)) {
            echo $csvData;
            $_SESSION['success'] = 'Attendance downloaded successfully';
            exit; // Stop script execution after downloading the file
        } else {
            $_SESSION['error'] = $conn->error;
        }
        
    } else {
        $_SESSION['error'] = 'No attendance data found';
    }
} else {
    $_SESSION['error'] = 'Invalid date range';
}

// Close the database connection
$stmt->close();
$conn->close();

// Redirect to home.php
header('location: home');
exit; // Ensure script execution stops after the redirect
?>
