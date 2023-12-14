<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all necessary fields are present
    if (isset($_POST['user_id']) && isset($_POST['product_id']) && isset($_POST['quantity'])) {
        // Extract data from the POST request
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Check if the item already exists in the cart for the user
        $check_existing = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $result = $conn->query($check_existing);

        if ($result->num_rows > 0) {
            // Update quantity if the item already exists in the cart
            $update_query = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = '$user_id' AND product_id = '$product_id'";
            if ($conn->query($update_query) === TRUE) {
                echo json_encode(array('status' => 'success', 'message' => 'Cart updated successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error updating cart: ' . $conn->error));
            }
        } else {
            // Insert new item into the cart
            $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
            if ($conn->query($insert_query) === TRUE) {
                echo json_encode(array('status' => 'success', 'message' => 'Item added to cart successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error adding item to cart: ' . $conn->error));
            }
        }
    } else {
        // Required fields are missing
        echo json_encode(array('status' => 'error', 'message' => 'Missing required fields'));
    }
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Method not allowed'));
}

// Close the database connection
$conn->close();
?>
