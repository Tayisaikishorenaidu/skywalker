<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ensure the product_id is provided
    if (isset($_GET['product_id'])) {
        // Extract product_id from the GET request
        $product_id = $_GET['product_id'];

        // Fetch product details for the given product ID
        $fetch_product_details = "SELECT * FROM products WHERE product_id = '$product_id'";
        $result = $conn->query($fetch_product_details);

        if ($result->num_rows > 0) {
            $product_details = $result->fetch_assoc();
            // Return product details as JSON response
            echo json_encode(array('status' => 'success', 'product_details' => $product_details));
        } else {
            // No product found for the given ID
            echo json_encode(array('status' => 'error', 'message' => 'Product not found'));
        }
    } else {
        // Product ID is missing
        echo json_encode(array('status' => 'error', 'message' => 'Product ID is missing'));
    }
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Method not allowed'));
}

// Close the database connection
$conn->close();
?>
