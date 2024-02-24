<?php
include_once('../db/dbconfig.php'); // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provider = $_POST['provider'];
    $description = $_POST['Description'];
    // Check if file is uploaded
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $file_size = $_FILES['image']['size'];

        // Check if there is no file upload error
        if ($file_error === 0) {
            // Set upload directory
            $upload_dir = 'uploads/';
            // Generate unique filename to prevent overwriting
            $file_destination = $upload_dir . uniqid() . '_' . $file_name;

            // Move uploaded file to destination
            if (move_uploaded_file($file_tmp, $file_destination)) {
                // Insert bus details into database
                $sql = "INSERT INTO buses (provider, image,Description) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $provider, $file_destination, $description);
                if ($stmt->execute()) {
                    echo "Bus registered successfully.";
                } else {
                    echo "Error registering bus: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "File upload error: " . $file_error;
        }
    } else {
        echo "Please select a file.";
    }
}
?>