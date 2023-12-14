<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all necessary fields are present
    if (
        isset($_POST['role_name']) && isset($_POST['description'])
    ) {
        // Extract data from the POST request
        $roleName = $_POST['role_name'];
        $description = $_POST['description'];

        // SQL query to insert role data into the database
        $sql = "INSERT INTO roles (role_name, description) 
                VALUES ('$roleName', '$description')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Role added successfully
            $response = array('status' => 'success', 'message' => 'Role added successfully');
            echo json_encode($response);
        } else {
            // Error occurred while adding role
            $response = array('status' => 'error', 'message' => 'Error adding role: ' . $conn->error);
            echo json_encode($response);
        }
    } else {
        // Required fields are missing
        $response = array('status' => 'error', 'message' => 'Missing required fields');
        echo json_encode($response);
    }
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Method not allowed'));
}

// Close the database connection
$conn->close();
?>
