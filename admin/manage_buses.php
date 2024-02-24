<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<?php
include_once('../db/dbconfig.php'); // Include database configuration

// Process delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $id = $_POST["delete_id"];

    // Delete the bus record from the database
    $sql = "DELETE FROM buses WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Bus deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Process edit operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_id"])) {
    $id = $_POST["edit_id"];
    $provider = $_POST['edit_provider'];
    $description = $_POST['edit_Description'];

    // Update bus details in the database
    $sql = "UPDATE buses SET provider=?, Description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $provider, $description, $id);
    if ($stmt->execute()) {
        echo "Bus updated successfully.";
    } else {
        echo "Error updating bus: " . $stmt->error;
    }
    $stmt->close();
}

// Process bus registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provider = $_POST['provider'];
    $description = $_POST['Description'];

    // Check if file is uploaded without any errors
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];

        // Set upload directory
        $upload_dir = 'uploads/';
        // Generate unique filename to prevent overwriting
        $file_destination = $upload_dir . uniqid() . '_' . $file_name;

        // Move uploaded file to destination
        if (move_uploaded_file($file_tmp, $file_destination,)) {
            // Insert bus details into database
            $sql = "INSERT INTO buses (provider, image, Description) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $provider, $file_destination,$description);
            if ($stmt->execute()) {
                echo "Bus registered successfully.";
            } else {
                echo "Error registering bus: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "File upload error: Please select a file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Buses</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/script_admin.js" defer></script>
    <?php include('../db/dbconfig.php'); ?>
</head>
<body style="background-image: url('../assets/admin.png'); background-size:cover; background-repeat:no-repeat;">
    <?php include_once('includes/header.php'); ?>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend><h1>Bus Registration</h1></legend>
                <label for="provider"> <i class="fa fa-bus"></i> Provider:</label>
                <input type="text" id="provider" name="provider" required><br><br>
                <label for="image">Upload Image&nbsp;<i class="fa fa-upload" style="color:gray" class="custom-file-label"></i></label>
                <input type="file" id="image" name="image" accept="image/*" class="custom-file-input"><br><br>
                <div class="textarea-container">
                    <label for="Description">Description:</label>
                    <textarea id="Description" name="Description" required maxlength="500"></textarea>
                    <div id="charCount">500 characters remaining</div>
                </div>
                <br><br>      
                <input type="submit" value="Register Bus">
            </fieldset>
        </form>
        
        <fieldset>
            <legend><h1>Registered Buses</h1></legend>
            <style>
                .bus-container {
                    display: flex;
                    flex-wrap: wrap;
                }
                .bus-card {
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    padding: 10px;
                    margin: 10px;
                    width: 200px;
                    height: 300px;
                }
                .descriptions{
                    height: 100px;
                    overflow: scroll;
                }
                .bus-image {
                    width: 100%;
                    height: 150px;
                    object-fit: cover;
                    border-radius: 5px;
                }
                fieldset{
                    overflow: scroll;
                }
                .editor{
                    max-width: 700px;
                    width: 700px;

                }
            </style>

            <div class="bus-container">
                <?php
                // Fetch buses from database and display
                $sql = "SELECT * FROM buses";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="bus-card">
                            <img class="bus-image" src="<?php echo $row['image']; ?>" alt="Bus Image">
                            <p><strong>Provider:</strong> <?php echo $row['provider']; ?></p>
                            <div class="descriptions">
                            <p><strong>Description:</strong> <?php echo $row['Description']; ?></p>
                            </div>
                            <!-- Edit Button -->
                            <button onclick="document.getElementById('editForm_<?php echo $row['id']; ?>').style.display = 'block'">Edit</button>
                            <!-- Delete Button -->
                            <button onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                        </div>

                        <!-- Edit Form -->
                        <div id="editForm_<?php echo $row['id']; ?>" style="display: none;">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    
    <fieldset>
        <legend><h1>Edit Bus Provider</h1></legend>
        <label for="edit_provider"> <i class="fa fa-bus"></i> Provider:</label>
        <input type="text" id="edit_provider" name="edit_provider" value="<?php echo $row['provider']; ?>" required><br><br>
        <label for="edit_image">Upload Image&nbsp;<i class="fa fa-upload" style="color:gray"></i></label>
        <input type="file" id="edit_image" name="edit_image" accept="image/*" class="custom-file-input"><br><br>
        <div class="textarea-container"><div class="editor">
            <label for="edit_Description">Description:</label>
            <textarea id="edit_Description" name="edit_Description" required maxlength="500"><?php echo $row['Description']; ?></textarea>
            <div id="charCount">500 characters remaining</div></div>
        </div>
        <br><br>      
        <input type="submit" value="Register Bus">
    </fieldset></form>
    </div>


                       
                        <?php
                    }
                } else {
                    echo "No buses found.";
                }
                ?>
            </div> </div>
        </fieldset>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var textArea = document.getElementById('Description');
            var charCount = document.getElementById('charCount');

            textArea.addEventListener('input', function() {
                var remaining = 500 - textArea.value.length;
                charCount.textContent = remaining + " characters remaining";
            });
        });

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this bus?")) {
                var form = document.createElement('form');
                form.method = 'post';
                form.action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>';

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_id';
                input.value = id;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
