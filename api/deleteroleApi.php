<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the ID field is present
    if (isset($_POST['id'])) {
        // Extract role ID from the POST request
        $id = $_POST['id'];

        // SQL query to delete the role from the database
        $sql = "DELETE FROM roles WHERE id = '$id'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Role deleted successfully
            $response = array('status' => 'success', 'message' => 'Role deleted successfully');
            echo json_encode($response);
        } else {
            // Error occurred while deleting role
            $response = array('status' => 'error', 'message' => 'Error deleting role: ' . $conn->error);
            echo json_encode($response);
        }
    } else {
        // Required field is missing
        $response = array('status' => 'error', 'message' => 'Missing role ID');
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
