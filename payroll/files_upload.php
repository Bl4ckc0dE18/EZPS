<?php
include 'includes/session.php';

if(isset($_POST["add"])) {

    // Enable error reporting for debugging purposes
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["f_upload"])) {
        $file = $_FILES["f_upload"];

        // Check if file was uploaded without errors
        if ($file["error"] == 0) {
            $filename = $file["name"];
            $tmpFilePath = $file["tmp_name"];

            // Check if file is a CSV file
            $fileType = pathinfo($filename, PATHINFO_EXTENSION);
            if ($fileType == "csv") {
                // Specify the directory where you want to save the uploaded file
                $uploadDirectory = "../uploads/";

                // Generate a unique name for the file
                $newFilePath = $uploadDirectory . uniqid() . '_' . $filename;

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    // Read CSV file and insert data into database
                    $file = fopen($newFilePath, "r");
                    if ($file !== false) {
                        while (($data = fgetcsv($file)) !== false) {
                            // Assuming your CSV file columns are in the order: employee_id, date, time_in, status, time_out, num_hr, num_ot, num_wl

                            // Check if the data already exists in the database
                            $existing_data_query = "SELECT COUNT(*) FROM attendance WHERE employee_id = '".$data[0]."' AND date = '".$data[1]."' AND time_in = '".$data[2]."' AND status = '".$data[3]."' AND time_out = '".$data[4]."' AND num_hr = '".$data[5]."' AND num_ot = '".$data[6]."' AND num_wl = '".$data[7]."'";
                            $existing_data_result = $conn->query($existing_data_query);
                            $existing_data_count = $existing_data_result->fetch_assoc()['COUNT(*)'];

                            if ($existing_data_count == 0) {
                                // Insert data into database
                                $sql = "INSERT INTO attendance (employee_id, date, time_in, status, time_out, num_hr, num_ot, num_wl) 
                                    VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[3] . "', '" . $data[4] . "', '" . $data[5] . "', '" . $data[6] . "', '" . $data[7] . "')";

                                // Execute SQL query
                                $result = $conn->query($sql);

                                // Check for errors
                                if (!$result) {
                                    echo "Error inserting data: " . $conn->error;
                                }
                            } else {
                                $_SESSION['error'] = "Data already exists in the database.";
                                fclose($file);
                                $conn->close();
                                header('location: home.php');
                                exit;
                            }
                        }
                        fclose($file);
                        $_SESSION['success'] =  "Data inserted successfully.";
                    } else {
                        $_SESSION['error'] =  "Error reading CSV file.";
                    }
                } else {
                    $_SESSION['error'] =  "Error uploading file.";
                }
            } else {
                $_SESSION['error'] =  "Only CSV files are allowed.";
            }
        } else {
            $_SESSION['error'] =  "Error uploading file: " . $file["error"];
        }
    }
}

// Close the database connection
$conn->close();

// Redirect to home.php
header('location: home');
exit; // Ensure script execution stops after the redirect


?>
