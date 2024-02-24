<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer support</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="js/script_user.js" defer></script>
 <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>

    <div class="container">
    <style>
        /* Table styling */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            background-color: #444;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #ddd;
        }

        /* View button styling */
        .view-btn {
            background-color: #333; /* Dark color */
            color: #fff; /* White text */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .view-btn:hover {
            background-color: black;
            color: gray;
        }
    </style>

<h2>Contact Us Messages</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Reply</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../db/dbconfig.php';

        // Check if form is submitted for reply or delete
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Reply functionality
            if (isset($_POST['reply_submit'])) {
                $message_id = $_POST['message_id'];
                $reply_message = $_POST['reply_message'];

                // Update the reply message in the database
                $sql = "UPDATE contact_us SET reply = '$reply_message' WHERE id = $message_id";
                if ($conn->query($sql) === TRUE) {
                    echo "Reply sent successfully.";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } 
            // Delete functionality
            elseif (isset($_POST['delete_submit'])) {
                $message_id = $_POST['message_id'];

                // Delete the message from the database
                $sql = "DELETE FROM contact_us WHERE id = $message_id";
                if ($conn->query($sql) === TRUE) {
                    echo "Message deleted successfully.";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }
        }

        // Fetching and displaying messages in a table
        $sql = "SELECT * FROM contact_us";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['subject'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "<td>" . ($row['reply'] ? $row['reply'] : "No reply yet.") . "</td>";
                echo "<td>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='message_id' value='" . $row['id'] . "'>";
                echo "<textarea name='reply_message' placeholder='Reply message'></textarea>";
                echo "<button type='submit' name='reply_submit' class='view-btn'>Reply</button>";
                echo "<button type='submit' name='delete_submit' class='view-btn'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No messages found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>
