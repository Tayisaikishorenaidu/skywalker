<?php
// Include your database connection or configuration file here
require 'config.php';

// Check if the required data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure all necessary fields are present
    $data = json_decode(file_get_contents('php://input'), true);
    // var_dump($_POST);
    // exit;
    if (
        isset($_POST['name']) && isset($_POST['price']) &&
        isset($_POST['quantity']) && isset($_POST['category'])) // Check if image file is uploaded
    {
        // Extract _POST from the POST request
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        
        // File handling for image upload
        $targetDirectory = 'uploads/'; // Specify the directory where images will be stored
        $targetFile = $targetDirectory . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check file size (you can set your own limit)
        // if ($_FILES['image']['size'] > 500000) {
        //     $uploadOk = 0;
        // }

        // Allow certain file formats (you can modify this based on allowed formats)
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $response = array('status' => 'error', 'message' => 'Sorry, your file was not uploaded.');
            echo json_encode($response);
        } else {
            // Attempt to upload image file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Image uploaded successfully, proceed with database insertion
                $image = $targetFile;

                // SQL query to insert product data into the database
                $sql = "INSERT INTO products (product_name, price, quantity, category, description, image_url) 
                        VALUES ('$name', '$price', '$quantity', '$category', '$description', '$image')";

                // Execute the query
                if ($conn->query($sql) === TRUE) {
                    // Product added successfully
                    $response = array('status' => 'success', 'message' => 'Product added successfully');
                    echo json_encode($response);
                } else {
                    // Error occurred while adding product
                    $response = array('status' => 'error', 'message' => 'Error adding product: ' . $conn->error);
                    echo json_encode($response);
                }
            } else {
                // Error uploading image file
                $response = array('status' => 'error', 'message' => 'Error uploading image file');
                echo json_encode($response);
            }
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
