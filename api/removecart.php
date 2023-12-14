<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via DELETE request
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Ensure the user_id and product_id are provided
    if (isset($_GET['user_id']) && isset($_GET['product_id'])) {
        // Extract user_id and product_id from the DELETE request
        $user_id = $_GET['user_id'];
        $product_id = $_GET['product_id'];

        // Remove the item from the cart for the given user
        $remove_item = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        if ($conn->query($remove_item) === TRUE) {
            echo json_encode(array('status' => 'success', 'message' => 'Item removed from cart successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error removing item from cart: ' . $conn->error));
        }
    } else {
        // User ID or Product ID is missing
        echo json_encode(array('status' => 'error', 'message' => 'User ID or Product ID is missing'));
    }
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Method not allowed'));
}

// Close the database connection
$conn->close();
?>
