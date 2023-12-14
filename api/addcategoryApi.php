<?php
// Define the directory where images will be stored
$uploadDirectory = 'uploads/';
require 'config.php';


// Check if the request is a POST request and required parameters are present
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoryName']) && isset($_FILES['categoryImage'])) {
    // Process the received data
    $categoryName = $_POST['categoryName'];
    $imageFile = $_FILES['categoryImage'];

    // Handle the uploaded image
    $targetFile = $uploadDirectory . basename($imageFile['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is an actual image or fake image
    $check = getimagesize($imageFile['tmp_name']);
    if ($check === false) {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadOk = 0;
    }

    // Check file size (you can adjust the file size limit as needed)
    if ($imageFile['size'] > 500000) {
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can adjust the allowed formats as needed)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // If everything is ok, try to upload file
    if ($uploadOk != 0) {
        if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
            // Here you can proceed to handle database operations or any further processing

            // Insert the category into the database
            $sql = "INSERT INTO categories (categoryName, categoryImage) VALUES ('$categoryName', '$targetFile')";

            if ($conn->query($sql) === TRUE) {
                echo "New category created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            // Close the database connection
            $conn->close();

            // For demonstration purposes, let's return a success response with image path
            $response = array(
                'status' => 'success',
                'message' => 'Category added successfully',
                'categoryName' => $categoryName,
                'categoryImage' => $targetFile // Return the path to the uploaded image
                // Add any other relevant information you want to return
            );

            // Return a JSON response
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $errorResponse = array(
                'status' => 'error',
                'message' => 'Sorry, there was an error uploading your file.'
            );

            // Return a JSON error response
            header('Content-Type: application/json');
            http_response_code(500); // Set appropriate HTTP status code
            echo json_encode($errorResponse);
        }
    } else {
        $errorResponse = array(
            'status' => 'error',
            'message' => 'Sorry, your file was not uploaded. Please check the file format and size.'
        );

        // Return a JSON error response
        header('Content-Type: application/json');
        http_response_code(400); // Set appropriate HTTP status code
        echo json_encode($errorResponse);
    }
} else {
    $errorResponse = array(
        'status' => 'error',
        'message' => 'Invalid request or missing parameters'
    );

    // Return a JSON error response
    header('Content-Type: application/json');
    http_response_code(400); // Set appropriate HTTP status code
    echo json_encode($errorResponse);
}
?>
