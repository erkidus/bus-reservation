<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="js/script_user.js" defer></script>
 <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>

    <div class="container">
        <?php

// Function to update username
function updateUsername($newUsername, $userId, $conn) {
    $updateQuery = "UPDATE users SET username = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newUsername, $userId);
    return $stmt->execute();
}

// Function to update email
function updateEmail($newEmail, $userId, $conn) {
    $updateQuery = "UPDATE users SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newEmail, $userId);
    return $stmt->execute();
}

// Function to update password
function updatePassword($newPassword, $userId, $conn) {
    $updateQuery = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newPassword, $userId);
    return $stmt->execute();
}

// Check if form submitted for updating username
if (isset($_POST['updateUsername'])) {
    $newUsername = $_POST['newUsername'];
    $userId = $_SESSION['user_id'];
    if (updateUsername($newUsername, $userId, $conn)) {
        echo "Username updated successfully.";
    } else {
        echo "Error updating username: " . $conn->error;
    }
}

// Check if form submitted for updating email
if (isset($_POST['updateEmail'])) {
    $newEmail = $_POST['newEmail'];
    $userId = $_SESSION['user_id'];
    if (updateEmail($newEmail, $userId, $conn)) {
        echo "Email updated successfully.";
    } else {
        echo "Error updating email: " . $conn->error;
    }
}

// Check if form submitted for updating password
if (isset($_POST['updatePassword'])) {
    $newPassword = $_POST['newPassword'];
    $userId = $_SESSION['user_id'];
    if (updatePassword($newPassword, $userId, $conn)) {
        echo "Password updated successfully.";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

?>

    <h2>User Account Modification</h2>

    <!-- Form to update username -->
    <fieldset >
    <form action="" method="post">
        <label for="newUsername">New Username:</label>
        <input type="text" id="newUsername" name="newUsername" required>
        <input type="submit" name="updateUsername" value="Update">
    </form>
    </fieldset>

    <!-- Form to update email -->
    <fieldset>
    <form action="" method="post">
        <label for="newEmail">New Email:</label>
        <input type="email" id="newEmail" name="newEmail" required>
        <input type="submit" name="updateEmail" value="Update">
    </form>
    </fieldset>

    <!-- Form to update password -->
    <fieldset>
    <form action="" method="post">
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <input type="submit" name="updatePassword" value="Update">
    </form>
    </fieldset>
</body>
</html>

    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
