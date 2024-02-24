<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script_admin.js" defer></script>
    <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>

    <div class="container">
        
    <form action="login_a.php" method="post">
    <fieldset>
    <legend><h1>Login</h1></legend>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
    <p>Not Registred?<a href="signup.php">Sign Up</a></p>
    </fieldset>
    </form>
    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
