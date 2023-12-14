<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect or return success response
    echo json_encode(array('status' => 'success', 'message' => 'Logout successful'));
} else {
    // User not logged in
    echo json_encode(array('status' => 'error', 'message' => 'User not logged in'));
}
?>
