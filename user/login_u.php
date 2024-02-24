<?php
session_start(); // Start session

include_once('../db/dbconfig.php'); // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if username and password match
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) { // If user found
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; // Store user ID in session
        $_SESSION['username'] = $row['username']; // Store username in session
        header("Location: index.php"); // Redirect to dashboard or any other page after login
        exit();
    } else {
        // Display error message using JavaScript alert and redirect to login page
        echo "<script>alert('Invalid username or password'); window.location.href = 'login.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
