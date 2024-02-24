<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "G3_Web-project";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if username already exists
    $check_username_sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_username_sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result_username = $stmt->get_result();
    if ($result_username->num_rows > 0) {
        echo "Username already exists.";
        exit();
    }
    $stmt->close();

    // Check if email already exists
    $check_email_sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result_email = $stmt->get_result();
    if ($result_email->num_rows > 0) {
        echo "Email already exists.";
        exit();
    }
    $stmt->close();

    // Insert user into database
    $insert_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        echo "Registration successful.";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script_user.js" defer></script>
    <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>
    <style>
    label, h2{
        color: white;
    }
</style>
    <div class="container">
        

<form action="" method="post">
    <fieldset>
    <legend><h1>Sign Up</h1></legend>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" name="submit" value="Register">
        <p>Already Registred?<a href="login.php">Login</a></p>
    </fieldset>
</form>

    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
