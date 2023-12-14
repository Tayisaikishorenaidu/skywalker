<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all necessary fields are present
    if (
        isset($_POST['username']) && isset($_POST['password']) &&
        isset($_POST['email']) && isset($_POST['role']) &&
        isset($_POST['phone'])
    ) {
        // Extract data from the POST request
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role']; // Assuming the role will be provided during signup
        $phone = $_POST['phone'];

        // Encrypt the password (using a hashing algorithm like bcrypt or SHA256)
        // For demonstration purposes, using MD5 hashing here (not recommended for production)
        $encryptedPassword = md5($password);

        // SQL query to insert user data into the database
        $sql = "INSERT INTO users (username, password, email, role, phone) 
                VALUES ('$username', '$encryptedPassword', '$email', '$role', '$phone')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // User registered successfully
            $response = array('status' => 'success', 'message' => 'User registered successfully');
            echo json_encode($response);
        } else {
            // Error occurred while registering user
            $response = array('status' => 'error', 'message' => 'Error registering user: ' . $conn->error);
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
