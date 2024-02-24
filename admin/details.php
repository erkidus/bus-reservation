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
include_once('../db/dbconfig.php');

if(isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    // Retrieve reservation details
    $sql = "SELECT * FROM reservations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $reservation_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Proceed with displaying the receipt
    } else {
        echo "No reservation found with ID: " . $reservation_id;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Reservation ID is not provided.";
}
?>

    <style>

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

    <div class="receipt">
        <h2>Urjigo Reservation Details</h2>
        <p><strong>Reservation ID:</strong> <?php echo $row['id']; ?></p>
        <p><strong>Full Name:</strong> <?php echo $row['fullname']; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $row['phone_number']; ?></p>
        <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
        <p><strong>Source:</strong> <?php echo $row['source']; ?></p>
        <p><strong>Destination:</strong> <?php echo $row['destination']; ?></p>
        <p><strong>Departure Date:</strong> <?php echo $row['departure_date']; ?></p>
        <p><strong>Seats Booked:</strong> <?php echo $row['seats_booked']; ?></p>
        <p><strong>Price:</strong> <?php echo $row['price']; ?></p>
        <p><strong>Reservation Date:</strong> <?php echo $row['reservation_date']; ?></p>

        
    </div><div class="btn-container">
            
            <button onclick="downloadImage()">Download Receipt</button>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script>

    function downloadImage() {
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



    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
