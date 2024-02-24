<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once('includes/header.php');
include_once('../db/dbconfig.php');

$user_id = $_SESSION['user_id'];

$reservation = null; // Initialize reservation variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the ticket number from the form submission
    $ticket = $_POST['ticket'];

    // Retrieve the reservation details based on the ticket number
    $sql = "SELECT r.*, b.provider AS bus_name FROM reservations r
            INNER JOIN buses b ON r.buses_id = b.id
            WHERE ticket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticket);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservation = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Receipt</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        /* CSS styles */
        .receipt {
            background-color: #fff;
            border: 1px solid #000;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .receipt h2 {
            color: #333;
        }
        .receipt p {
            margin: 5px 0;
        }
        .receipt .details {
            margin-top: 20px;
        }
        .receipt .details th {
            background-color: black;
            color: white;
            padding: 10px;
        }
        .receipt .details td {
            background-color: #ddd;
            padding: 10px;
        }
        .btn-container {
            margin-top: 20px;
            text-align: center;
        }
        .btn-container button {
            padding: 10px 20px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php include_once('includes/header.php'); ?>
</head>
<style>
    label, h2{
        color: white;
    }
</style>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <div class="container">
        <br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="ticket">Enter Ticket Number:</label>
            <input type="text" id="ticket" name="ticket">
            <button type="submit">Fetch Reservation</button>
        </form>

        <?php if ($reservation): ?>
        <div class="receipt">
            <h2>Urjigo Receipt</h2><hr>
            <p><strong>Reservation ID:</strong> <?php echo $reservation['id']; ?></p>
            <p><strong>Full Name:</strong> <?php echo $reservation['fullname']; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $reservation['phone_number']; ?></p>
            <p><strong>Address:</strong> <?php echo $reservation['address']; ?></p>
            <p><strong>Source:</strong> <?php echo $reservation['source']; ?></p>
            <p><strong>Destination:</strong> <?php echo $reservation['destination']; ?></p>
            <p><strong>Departure Date:</strong> <?php echo $reservation['departure_date']; ?></p>
            <p><strong>Seats Booked:</strong> <?php echo $reservation['seats_booked']; ?></p>
            <p><strong>Price:</strong> <?php echo $reservation['price']; ?></p>
            <p><strong>Bus Name:</strong> <?php echo $reservation['bus_name']; ?></p>
            <p><strong>Ticket Number:</strong> <?php echo $reservation['ticket']; ?></p>
            <p><strong>Reservation Date:</strong> <?php echo $reservation['reservation_date']; ?></p>
            <hr>
            <center><h4><i>Thanks for choosing Urjigo!</i></h4></center>
        </div>
        <div class="btn-container">
            <button onclick="downloadReceipt()">Download Receipt</button>
        </div>
        <?php endif; ?>

        <hr>
        <center><a href="index.php">Back To home</a></center>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script>
        function downloadReceipt() {
            html2canvas(document.querySelector('.receipt'), {
                scale: 2,
                logging: true,
                onrendered: function(canvas) {
                    let img = canvas.toDataURL('image/png');
                    let link = document.createElement('a');
                    link.href = img;
                    link.download = 'receipt.png';
                    link.click();
                }
            });
        }
    </script>
    
</body><?php include_once('includes/footer.php'); ?>
</html>
