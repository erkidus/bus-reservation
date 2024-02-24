<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once('includes/header.php');
include_once('../db/dbconfig.php');

// Define sources and their corresponding destinations
$sources = array(
    "Select Source" => array("Select Destination"),
    "Addis Ababa" => array("Bahirdar", "Hawassa", "Arbaminch", "Wolaita", "Gonder", "Jimma"),
    "Hawassa" => array("Addis Ababa"),
    "Jimma" => array("Addis Ababa"),
    "Arbaminch" => array("Addis Ababa"),
    "Gonder" => array("Addis Ababa"),
    "Bahirdar" => array("Addis Ababa")
);

// Fetch all buses from the database
$sql = "SELECT id, provider FROM buses";
$result = $conn->query($sql);

$buses = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $buses[$row['id']] = $row['provider'];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validate form inputs (sanitize and validate)
        $fullname = $_POST['fullname'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $source = $_POST['source'];
        $destination = $_POST['destination'];
        $departure_date = date("Y-m-d", strtotime($_POST['departure_date'])); // Format departure date properly
        $seats_booked = $_POST['seats_booked'];
        $price = $_POST['price'];
        $ticket = $_POST['ticket'];
        $reservation_date = date("Y-m-d H:i:s"); // Current date and time
        
        // Retrieve bus ID from the form
        $bus_id = $_POST['bus_id'];
        
        // Retrieve user ID from session
        $user_id = $_SESSION['user_id'];

        // Insert reservation into database
        $sql = "INSERT INTO reservations (fullname, phone_number, address, source, destination, departure_date, seats_booked, price, reservation_date, buses_id, ticket, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssidsiii", $fullname, $phone_number, $address, $source, $destination, $departure_date, $seats_booked, $price, $reservation_date, $bus_id, $ticket, $user_id);
        
        // Execute the prepared statement
        $stmt->execute();

        // Retrieve the ticket number generated for the reservation
        $ticket = $conn->insert_id;

        // Display JavaScript alert
        echo '<script>alert("Reservation successfully created.");</script>';
        // Redirect to receipt.php after reservation creation
        echo '<script>window.location.href = "receipt.php?ticket=' . urlencode($ticket) . '";</script>';
    } catch (mysqli_sql_exception $e) {
        // Check if error is due to duplicate ticket value
        if ($e->getCode() == 1062) {
            echo '<script>alert("Duplicate ticket number. Please choose a different ticket number.");</script>';
        } else {
            $error = "Error creating reservation: " . $e->getMessage();
        }
    } finally {
        // Close statement
        $stmt->close();
    }
}
?>
<html>
<style>
    label, h2{
        color: white;
    }
</style>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-ym4/2hMTKmq37j1Xb9k8wfNYf5xw0H61JBq7N+IYPv8P6L2/3exzOuB2hXuNjBy3yy4D2oXlcEbqXEG7Vld9IA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../css/styles.css">
<style>

    .form-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: #333;
        border-radius: 10px;
    }

    h2 {
        color: #fff;
        font-size: 24px;
        margin-bottom: 20px;
    }

    fieldset {
        border: none;
        margin: 0;
        padding: 0;
    }

    legend {
        color: #fff;
        font-size: 18px;
        margin-bottom: 10px;
    }

    label {
        color: #fff;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #fff;
        border-radius: 5px;
        background-color: #1f1f1f;
        color: #fff;
    }

    input[type="date"] {
        width: calc(100% - 22px);
    }

    input[type="submit"] {
        background-color: #fff;
        color: #333;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }

    hr {
        border-color: #fff;
        margin: 20px 0;
    }
</style>

<div class="form-container">
    <h2>Make a Reservation <i class="fas fa-ticket-alt"></i></h2>
    <?php if (isset($message)) { ?>
        <div><?php echo $message; ?></div>
    <?php } ?>
    <?php if (isset($error)) { ?>
        <div><?php echo $error; ?></div>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Contact Information</legend>
            <label for="fullname"><i class="fas fa-user"></i> Full Name:</label>
            <input type="text" name="fullname" required>

            <label for="phone_number"><i class="fas fa-phone"></i> Phone Number:</label>
            <input type="text" name="phone_number" required>

            <label for="address"><i class="fas fa-map-marker-alt"></i> Address:</label>
            <input type="text" name="address" required>
        </fieldset>

        <fieldset>
            <legend>Reservation Details</legend>
            <label for="ticket"><i class="fas fa-ticket-alt"></i> Ticket:</label>
            <input type="number" name="ticket" required>

            <label for="source"><i class="fas fa-map-marker-alt"></i> Source:</label>
            <select name="source" id="source" required>
                <?php foreach ($sources as $src => $dests) { ?>
                    <option value="<?php echo $src; ?>"><?php echo $src; ?></option>
                <?php } ?>
            </select>

            <label for="destination"><i class="fas fa-map-marker-alt"></i> Destination:</label>
            <select name="destination" id="destination" required>
                <!-- Destination options will be populated based on selected source using JavaScript -->
            </select>

            <label for="departure_date"><i class="fas fa-calendar-alt"></i> Departure Date:</label>
            <input type="date" name="departure_date" id="departure_date" required>

            <label for="seats_booked"><i class="fas fa-chair"></i> Number of Seats:</label>
            <select name="seats_booked" id="seats_booked" required>
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>

            <label for="bus_id"><i class="fas fa-bus"></i> Select Bus:</label>
            <select name="bus_id" id="bus_id" required>
                <?php foreach ($buses as $bus_id => $provider) { ?>
                    <option value="<?php echo $bus_id; ?>"><?php echo $provider; ?></option>
                <?php } ?>
            </select>
        </fieldset>

        <hr>

        <div id="calculated_price"></div>
        <input type="hidden" name="price" id="price" value="0">
        <input type="hidden" name="total_amount" id="total_amount" value="0">

        <input type="submit" value="Submit">
    </form>
</div>


<!-- JavaScript to populate destination options based on selected source -->
<script>
document.getElementById('source').addEventListener('change', function() {
    var source = this.value;
    var destinations = <?php echo json_encode($sources); ?>;
    var destinationSelect = document.getElementById('destination');
    destinationSelect.innerHTML = '';
    var dests = destinations[source];
    for (var i = 0; i < dests.length; i++) {
        var option = document.createElement('option');
        option.value = dests[i];
        option.textContent = dests[i];
        destinationSelect.appendChild(option);
    }
});

document.getElementById('destination').addEventListener('change', function() {
    var source = document.getElementById('source').value;
    var destination = this.value;
    var price = 0;

    // Calculate distance based on provided distances
    var distances = {
        "Addis Ababa": {
            "Bahirdar": 483.6,
            "Hawassa": 278,
            "Arbaminch": 451.7,
            "Wolaita": 280.7,
            "Gonder": 657.3,
            "Jimma": 348.2
        },
        "Hawassa": {
            "Addis Ababa": 278
        },
        "Jimma": {
            "Addis Ababa": 348.2
        },
        "Arbaminch": {
            "Addis Ababa": 451.7
        },
        "Gonder": {
            "Addis Ababa": 657.3
        },
        "Bahirdar": {
            "Addis Ababa": 483.6
        }
    };

    if (source !== "Select Source" && destination !== "Select Destination") {
        var distance = distances[source][destination];
        // Calculate the base price for 200km
        var basePrice = Math.ceil(distance / 200) * 600;

        // Get the number of seats booked
        var seatsBooked = parseInt(document.getElementById('seats_booked').value);

        // Calculate the total price based on the number of seats
        price = basePrice * seatsBooked;
    }

    // Update the price input field with the calculated price
    document.getElementById('price').value = price;
    document.getElementById('total_amount').value = price;

    // Display the calculated price above the full name field
    document.getElementById('calculated_price').innerHTML = 'Calculated Price: ' + price + ' ETB';
});

document.getElementById('seats_booked').addEventListener('change', function() {
    var source = document.getElementById('source').value;
    var destination = document.getElementById('destination').value;
    var price = 0;

    // Calculate distance based on provided distances
    var distances = {
        "Addis Ababa": {
            "Bahirdar": 483.6,
            "Hawassa": 278,
            "Arbaminch": 451.7,
            "Wolaita": 280.7,
            "Gonder": 657.3,
            "Jimma": 348.2
        },
        "Hawassa": {
            "Addis Ababa": 278
        },
        "Jimma": {
            "Addis Ababa": 348.2
        },
        "Arbaminch": {
            "Addis Ababa": 451.7
        },
        "Gonder": {
            "Addis Ababa": 657.3
        },
        "Bahirdar": {
            "Addis Ababa": 483.6
        }
    };

    if (source !== "Select Source" && destination !== "Select Destination") {
        var distance = distances[source][destination];
        // Calculate the base price for 200km
        var basePrice = Math.ceil(distance / 200) * 600;

        // Get the number of seats booked
        var seatsBooked = parseInt(document.getElementById('seats_booked').value);

        // Calculate the total price based on the number of seats
        price = basePrice * seatsBooked;
    }

    // Update the price input field with the calculated price
    document.getElementById('price').value = price;
    document.getElementById('total_amount').value = price;

    // Display the calculated price above the full name field
    document.getElementById('calculated_price').innerHTML = 'Calculated Price: ' + price + ' ETB';
});
</script>

<?php include_once('includes/footer.php'); ?>
</body></html>