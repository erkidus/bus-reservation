<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <!-- Add your CSS styles here -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
</head>
<body style="background-image: url('assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <header>
    <style>
    label, h2{
        color: white;
    }
</style>
<style>
        /* Navbar styles */
        .navbar {
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000; /* Ensure the navbar is on top of other content */
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar a i {
            margin-right: 5px; /* Add some space between icon and text */
        }
        /* Parallax effect styles */
        .parallax-section {
            height: 100vh;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .parallax-content {
            z-index: 1;
            position: relative;
        }
        /* Footer styles */
        footer {
            display: flex;
            justify-content: center; /* Aligning content horizontally at the center */
            align-items: center; /* Aligning content vertically at the center */
            padding: 20px 0; /* Adjust padding as needed */
            background-color: #333;
            color: #f2f2f2;
            text-align: center;
            padding: 20px 0;
            width: 100%;
        }
        /* Set background images for each section */
        .parallax-section {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .back-to-top:hover {
            background-color: #555;
        }
        .back-to-top i {
            font-size: 20px;
        }
.social-icons {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .social-icons li {
            margin-right: 10px;
        }

        .social-icons li a {
            text-decoration: none;
            display: flex;
            align-items: center;
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .social-icons li a:hover {
            color: #000000;
        }

        .social-icons li a i {
            font-size: 24px;
            margin-right: 5px;
        }

        .social-icons li span {
            font-size: 16px;
        }
    </style>
<div class="navbar">
    <a href="index.php"><i class="fas fa-home"></i>Home</a>
    <a href="contactus.php"><i class="fas fa-envelope"></i>Contact Us</a>
    <a href="admin/"><i class="fas fa-user-shield"></i>Admin</a>
    <a href="user/"><i class="fas fa-user"></i>User</a>
</div>
    </header>


    <!-- FAQ Section -->
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div>
            <?php
            include_once 'db/dbconfig.php';
            
            $sql = "SELECT * FROM contact_us";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<fieldset>";
                    echo "<legend>" . $row['name'] . "</legend>";
                    echo "<p><strong>Question:</strong> " . $row['message'] . "</p>";
                    echo "<p><strong>Reply:</strong> " . ($row['reply'] ? $row['reply'] : "No reply yet.") . "</p>";
                    echo "</fieldset>";
                }
            } else {
                echo "No messages found.";
            }
            ?>
        </div>
    </div>

    <footer>
        <footer>
    <p>&copy; 2024 Urji Go</p>
</footer>
</footer>

</body>
</html>
