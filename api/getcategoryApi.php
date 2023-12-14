<?php
// Include your database connection script (config.php or any other file)
require 'config.php';

// Fetch categories from the database
$sql = "SELECT id, categoryName, categoryImage FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $categories = array();

    // Fetch each row from the result set
    while ($row = $result->fetch_assoc()) {
        // Store each category's data in an array
        $category = array(
            'id' => $row['id'],
            'categoryName' => $row['categoryName'],
            'categoryImage' => $row['categoryImage']
        );

        // Add the category to the categories array
        $categories[] = $category;
    }

    // Output the categories as JSON
    header('Content-Type: application/json');
    echo json_encode($categories);
} else {
    // If no categories found
    $errorResponse = array(
        'status' => 'error',
        'message' => 'No categories found'
    );
    header('Content-Type: application/json');
    http_response_code(404); // Not Found
    echo json_encode($errorResponse);
}

// Close the database connection
$conn->close();
?>
