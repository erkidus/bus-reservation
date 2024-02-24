<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<style>
    p, h1{
        color: white;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Reservation System</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="js/script_user.js" defer></script>
    <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
<?php include_once('includes/header.php'); ?>

<div class="container">
    <style>
        
        .container{
            width: 90%;
            max-width: 90%;
        }
        h1{
            border: groove #1f1f1f;
            background-color: rgba(31, 31, 31, 0.8);
            border-radius: 10px;
            padding: 20px;
            width: fit-content;
        }
    </style>
    <br><br>
   <center>
   <h1><i class="fas fa-bus"></i>Welcome to Urji Go Bus Reservations</h1>
    <form action="index.php" method="GET">
        <input type="text" name="provider" placeholder="Search by Provider">
        <button type="submit"><i class="fas fa-search"></i> Search</button>
    </form>
   </center>
   <br><br><br><br>
    <br>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
        }
        .card {
            width: 250px;
            height: 300px;
            perspective: 1000px;
            margin: 10px;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
        }
        .card:hover .card-inner {
            transform: rotateY(180deg);
        }
        .card .card-inner {
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.8s;
        }
        .card-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            padding: 20px;
            box-sizing: border-box;
            transform: rotateY(0deg);
        }
        .front {
            background-color: rgba(31, 31, 31, 0.8);
            z-index: 2;
        }
        .back {
            background-color: rgba(31, 31, 31, 0.8);
            transform: rotateY(180deg);
        }
        .bus-image {
            max-width: 100%;
            max-height: 50%;
            border-radius: 15px;
            margin-bottom: 20px;
        }
    </style>
    <div class="card-container">
        <?php
        // Fetching data from the database based on the provider search criteria
        $sql = "SELECT id, provider, image, Description FROM buses";

        // Check if search parameter is provided
        if(isset($_GET['provider'])) {
            $provider = $_GET['provider'];
            // Adjust SQL query to filter buses based on search criteria
            $sql = "SELECT id, provider, image, Description FROM buses WHERE provider LIKE '%$provider%'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<a href="reservation.php?buses_id='.$row['id'].'" class="card">';
                echo '<div class="card-inner">';
                echo '<div class="card-face front">';
                echo '<img class="bus-image" src="' . $row['image'] . '" alt="Bus Image">';
                echo '<p>'.$row['provider'].'</p>';
                echo '</div>';
                echo '<div class="card-face back">';
                echo '<p style="font-size:14px;">'.$row['Description'].'</p>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>
</body>
</html>
