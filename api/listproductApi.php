<?php
// Include your database connection or configuration file here
require 'config.php';

// SQL query to retrieve all products
$sql = "SELECT * FROM products";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = array();
    // Fetch data from the result set
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    // Return products as JSON response
    echo json_encode(array('status' => 'success', 'products' => $products));
} else {
    // No products found
    echo json_encode(array('status' => 'success', 'message' => 'No products found'));
}

// Close the database connection
$conn->close();
?>
