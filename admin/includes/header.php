<?php
// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['admin'])) {
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php"><i class="fas fa-bus"></i> Urjigo</a></li>
            </ul>
        </nav>
    </header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <?php

} else {
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="account.php"><i class="fas fa-user-circle"></i> Account</a></li>
                <li><a href="customersupport.php"><i class="fas fa-headset"></i> Customer Support</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
    </header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <?php
}
?>
