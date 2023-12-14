<?php
require 'config.php'; // Include your database connection script

// Fetch products from the database
$sql = "SELECT product_id, product_name, price, image_url FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = array();

    // Fetch each row from the result set
    while ($row = $result->fetch_assoc()) {
        // Store each product's data in an array
        $product = array(
            'id' => $row['product_id'],
            'productName' => $row['product_name'],
            'price' => $row['price'],
            'imagePath' => $row['image_url']
        );

        // Add the product to the products array
        $products[] = $product;
    }

    // Output the products as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
} else {
    // If no products found
    $errorResponse = array(
        'status' => 'error',
        'message' => 'No products found'
    );
    header('Content-Type: application/json');
    http_response_code(404); // Not Found
    echo json_encode($errorResponse);
}

// Close the database connection
$conn->close();
?>
