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
    <title>View Reservations</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script_admin.js" defer></script>
 <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>

    <div class="container">
    <?php
include_once('../db/dbconfig.php'); // Include database configuration

// Fetch reservation data from the database
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);
?>

    <style>
        /* Table styling */
        table {
            border-collapse: collapse;
            width: 100%;
            overflow: auto;
            border: 1px solid black;
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

        ::-webkit-scrollbar {
            width: 12px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #888;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
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
</head>
<body>
    <h2>View Reservations</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Departure Date</th>
                <th>Seats Booked</th>
                <th>Price</th>
                <th>Reservation Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['source']; ?></td>
                        <td><?php echo $row['destination']; ?></td>
                        <td><?php echo $row['departure_date']; ?></td>
                        <td><?php echo $row['seats_booked']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['reservation_date']; ?></td>
                        <td><a href="details.php?id=<?php echo $row['id']; ?>" class="view-btn">View</a></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='11'>No reservations found.</td></tr>";
            }
            ?>
        </tbody>
    </table>


    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
