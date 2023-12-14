<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all necessary fields are present
    if (
        isset($_POST['id']) && isset($_POST['role_name']) && isset($_POST['description'])
    ) {
        // Extract data from the POST request
        $id = $_POST['id'];
        $roleName = $_POST['role_name'];
        $description = $_POST['description'];

        // SQL query to update role data in the database
        $sql = "UPDATE roles SET 
                role_name = '$roleName', 
                description = '$description' 
                WHERE id = '$id'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Role updated successfully
            $response = array('status' => 'success', 'message' => 'Role updated successfully');
            echo json_encode($response);
        } else {
            // Error occurred while updating role
            $response = array('status' => 'error', 'message' => 'Error updating role: ' . $conn->error);
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
