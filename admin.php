<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
   
</head>
<body>
<nav class="navbar">
        <div class="logo">
            <a href="#"><span>Captured Moments</span></a>
        </div>
        <div class="list-section">
            <ul class="nav-items">
            
                <li><a href="admin.php">Gallery manager</a></li>
                <li><a href="retrieve_data.php">Message</a></li>
               
            </ul>
        </div>
        <div class="btn-section" id="auth-buttons">  <!-- Add id here for login and 
            register buttons -->
            <button class="login" onclick="onLogin()">Login</button>
            <button class="register" onclick="onRegister()">Register</button>
        </div>
    </nav>

    <div class="admin-title">    
    <h1>Admin Panel</h1>
    </div>

    <!-- Form to Add Photo -->
    <h2>Add Photo</h2>
    <form class="form1" action="admin.php" method="POST" enctype="multipart/form-data">
     
        <input type="file" name="photo" id="file" required>
        <input type="submit" name="add" value="Add Photo">
    </form>

    <h2>Existing Photos</h2>
    <div class="photo-list">
        <?php
        // Enable error reporting
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Database connection
        $conn = new mysqli('localhost', 'root', '',
         'captured_moments'); // Update credentials as needed

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle adding photo
        if (isset($_POST['add'])) {
            $target_dir = "images/"; // Directory to save images
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);

            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO photos (image_path) VALUES ('$target_file')";
                $conn->query($sql);
                echo "<p>Photo added successfully.</p>";
            } else {
                echo "<p>Error uploading photo.</p>";
            }
        }

        // Handle deleting selected photos
        if (isset($_POST['delete'])) {
            if (isset($_POST['photo_id']) && is_array($_POST['photo_id'])) {
                foreach ($_POST['photo_id'] as $id) {
                    // Fetch the image path
                    $sql = "SELECT image_path FROM photos WHERE id = $id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        unlink($row['image_path']); // Delete the file from the server
                        $conn->query("DELETE FROM photos WHERE id = $id"); // Delete from database
                    }
                }
                echo "<script>
                    alert('Photo deleted successfully!');
                  </script>";
            } else {
                echo "<p>No photos selected for deletion.</p>";
            }
        }
        // Fetch existing photos
        $sql = "SELECT * FROM photos";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<form method='POST' action='admin.php'>"; // Open form for deleting photos
            while ($row = $result->fetch_assoc()) {
                echo "<div class='photo-item'>";
                echo "<img src='" . $row['image_path'] . "' alt='Photo' >";
                echo "<input type='checkbox' name='photo_id[]' value='" . $row['id'] . "'>";
                echo "</div>";
            }
            echo "<input class='delete-btn' type='submit' name='delete' value='Delete Selected Photos'>";
            echo "</form>"; // Close form
        } else {
            echo "<p>No photos available.</p>"; // No photos found message
        }

        $conn->close();
        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
