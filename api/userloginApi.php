<?php
// Include your database connection or configuration file here
require 'config.php';

// Start the session
session_start();

// Check if the required data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all necessary fields are present
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['password'])) {
        // Extract username and password from the POST request
        $username = $data['username'];
        $password = $data['password'];

        // Encrypt the password (using a hashing algorithm like bcrypt or SHA256)
        // For demonstration purposes, using MD5 hashing here (not recommended for production)
        $encryptedPassword = $password;

        // SQL query to fetch user details based on username and password
        $sql = "SELECT user_id, username, email FROM users WHERE email = '$username' AND password = '$encryptedPassword' AND role_id = 2";

        // Execute the query
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, fetch user details including role
            $user = $result->fetch_assoc();
            // Start a session for the user
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Return user details including role as JSON response
            echo json_encode(array('status' => 'success', 'user' => $user));
        } else {
            // User not found or invalid credentials
            $response = array('status' => 'error', 'message' => 'Invalid username or password');
            echo json_encode($response);
        }
    } else {
        // Required fields are missing
        $response = array('status' => 'error', 'message' => 'Missing username or password');
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
