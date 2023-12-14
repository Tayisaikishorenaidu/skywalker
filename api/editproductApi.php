<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all necessary fields are present
    if (
        isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price']) &&
        isset($_POST['quantity']) && isset($_POST['category']) &&
        isset($_POST['description']) && isset($_POST['image'])
    ) {
        // Extract data from the POST request
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $image = $_POST['image'];

        // SQL query to update product data in the database
        $sql = "UPDATE products SET 
                name = '$name', 
                price = '$price', 
                quantity = '$quantity', 
                category = '$category', 
                description = '$description', 
                image = '$image' 
                WHERE id = '$id'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Product updated successfully
            $response = array('status' => 'success', 'message' => 'Product updated successfully');
            echo json_encode($response);
        } else {
            // Error occurred while updating product
            $response = array('status' => 'error', 'message' => 'Error updating product: ' . $conn->error);
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
