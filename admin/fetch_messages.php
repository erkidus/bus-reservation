<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Messages</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script_admin.js" defer></script>
 <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>

    <div class="container">
        <h1>Messages</h1>
        <!-- Display fetched messages here -->
    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
