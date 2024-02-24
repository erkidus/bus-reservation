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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <script src="../js/script_admin.js" defer></script>
    <?php include('../db/dbconfig.php'); ?>
    <style>
        /* Add CSS for the card-style links */
        .container ul {
            list-style-type: none;
            padding: 0;
        }

        .container ul li {
            background-color: white;
            border: 2px solid #000;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .container ul li:hover {
            border-color: black;
            box-shadow: 0 0 20px black;
        }

        .container ul li a {
            text-decoration: none;
            color: #000;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .container ul li a i {
            margin-right: 10px;
        }
    </style>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>

    <div class="container">
        <h1>Admin Dashboard</h1>
        <ul>
            <li><a href="manage_buses.php"><i class="fas fa-bus"></i> Manage Buses</a></li>
            <li><a href="view_reservations.php"><i class="fas fa-list"></i> View Reservations</a></li>
            <li><a href="view_users.php"><i class="fas fa-users"></i> View Users</a></li>
            <li><a href="account.php"><i class="fas fa-user-edit"></i> Edit Own Account</a></li>
            <li><a href="customersupport.php"><i class="fas fa-headset"></i> Customer Support</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Exit</a></li>
        </ul>
    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
