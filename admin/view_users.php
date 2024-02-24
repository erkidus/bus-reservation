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
    <title>View Users</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script_admin.js" defer></script>
    <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>

    <div class="container">
        <?php
        include_once('../db/dbconfig.php'); // Include database configuration

        // Fetch user data from the database
        $sql = "SELECT * FROM users";
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
        <h2>View Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr id="userRow_<?php echo $row['id']; ?>"> <!-- Assign unique ID to each row -->
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <button class="view-btn" onclick="showEditForm(<?php echo $row['id']; ?>)">Edit</button>
                                <a href="?delete=<?php echo $row['id']; ?>" class="view-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                }

                // Handle delete operation
                if(isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    // Perform the delete operation
                    $sql = "DELETE FROM users WHERE id=$id";
                    if ($conn->query($sql) === TRUE) {
                        echo "User deleted successfully.";
                        // Refresh the page after deletion
                        echo "<meta http-equiv='refresh' content='0'>";
                        exit();
                    } else {
                        echo "Error deleting user: " . $conn->error;
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Edit User Form (Initially Hidden) -->
        <div id="editFormContainer" style="display: none;">
            <h2>Edit User</h2>
            <form id="editForm" action="" method="post">
                <input type="hidden" id="editId" name="editId">
                <label for="editUsername">Username:</label>
                <input type="text" id="editUsername" name="editUsername" required><br><br>
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="editEmail" required><br><br>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>

    <script>
   function showEditForm(userId) {
    // Debugging: Log the user ID
    console.log('User ID:', userId);

    // Get the table row corresponding to the user ID
    var row = document.getElementById('userRow_' + userId);
    if (!row) {
        console.error('User row not found for user ID:', userId);
        return;
    }

    // Debugging: Log the table row
    console.log('User row:', row);

    // Extract user data from the table cells in the row
    var id = row.cells[0].textContent;
    var username = row.cells[1].textContent;
    var email = row.cells[2].textContent;

    // Populate the edit form fields with user data
    document.getElementById('editId').value = id;
    document.getElementById('editUsername').value = username;
    document.getElementById('editEmail').value = email;
    document.getElementById('editFormContainer').style.display = 'block';
}

</script>


    <?php include_once('includes/footer.php'); ?>
</body>
</html>
