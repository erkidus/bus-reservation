<?php
include_once('../db/dbconfig.php'); // Include database configuration

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Retrieve bus details based on ID
    $sql = "SELECT * FROM buses WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Display a form to edit provider
        ?>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="provider">Provider:</label>
            <input type="text" name="provider" value="<?php echo $row['provider']; ?>">
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Bus not found";
    }
}

$conn->close();
?>
