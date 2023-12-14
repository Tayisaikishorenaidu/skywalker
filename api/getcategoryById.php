<?php
// Include your database connection script (config.php or any other file)
require 'config.php';

// Check if the category ID is provided in the request
if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    // Fetch products by category ID from the database
    $sql = "SELECT product_id, product_name, price, image_url FROM products WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();

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
        // If no products found for the given category ID
        $errorResponse = array(
            'status' => 'error',
            'message' => 'No products found for the specified category ID'
        );
        header('Content-Type: application/json');
        http_response_code(404); // Not Found
        echo json_encode($errorResponse);
    }

    $stmt->close();
} else {
    // If the category ID is missing in the request
    $errorResponse = array(
        'status' => 'error',
        'message' => 'Missing category ID parameter'
    );
    header('Content-Type: application/json');
    http_response_code(400); // Bad Request
    echo json_encode($errorResponse);
}

// Close the database connection
$conn->close();
?>
