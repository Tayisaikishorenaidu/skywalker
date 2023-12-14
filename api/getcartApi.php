<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ensure the user_id is provided
    if (isset($_GET['user_id'])) {
        // Extract user_id from the GET request
        $user_id = $_GET['user_id'];

        // Fetch cart items with product details for the given user by joining tables
        $fetch_cart_items = "
            SELECT cart.product_id, cart.quantity,products.image_url, products.product_name, products.price
            FROM cart
            INNER JOIN products ON cart.product_id = products.product_id
            WHERE cart.user_id = '$user_id'
        ";
        $result = $conn->query($fetch_cart_items);

        if ($result->num_rows > 0) {
            $cart_items = array();
            while ($row = $result->fetch_assoc()) {
                $cart_items[] = array(
                    'product_id' => $row['product_id'],
                    'quantity' => $row['quantity'],
                    'product_name' => $row['product_name'],
                    'price' => $row['price'],
                    'image'=> $row['image_url'],
                    // Add more product details if needed
                );
            }
            // Return cart items with product details as JSON response
            echo json_encode(array('status' => 'success', 'cart_items' => $cart_items));
        } else {
            // No items found in the cart for the user
            echo json_encode(array('status' => 'success', 'cart_items' => []));
        }
    } else {
        // User ID is missing
        echo json_encode(array('status' => 'error', 'message' => 'User ID is missing'));
    }
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Method not allowed'));
}

// Close the database connection
$conn->close();
?>
