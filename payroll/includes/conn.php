<?php
	$conn = new mysqli('localhost', 'root', '', 'ezps');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>