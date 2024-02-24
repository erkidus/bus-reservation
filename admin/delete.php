<?php
include_once('../db/dbconfig.php'); // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ID is set and is a valid number
    if(isset($_POST["id"]) && is_numeric($_POST["id"])) {
        $id = $_POST["id"];

        // Delete the bus record from the database
        $sql = "DELETE FROM buses WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the page where buses are listed
            header("Location: register_bus.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Invalid ID";
    }
}

$conn->close();
?>
