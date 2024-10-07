<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kumari Gallery</title>
    <link rel="stylesheet" href="kumaristyle.css">
</head>
<body>
    <div class="g-title">
        <span>Indra Jātrā – येँयाः पुन्हि</span>
    </div>

    <div class="filter">
        <form method="GET" action="">
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort">
                <option value="Last Added" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'Last Added') echo 'selected'; ?>>Last Added</option>
                <option value="First Added" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'First Added') echo 'selected'; ?>>First Added</option>
            </select>
            <input type="submit" value="Sort">
        </form>
    </div>

    <div class="images-container">
        <div class="image-box">
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'captured_moments');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Determine sort order based on dropdown selection
            $sortOrder = 'DESC'; // Default to last added
            if (isset($_GET['sort'])) {
                if ($_GET['sort'] === 'First Added') {
                    $sortOrder = 'ASC'; // Change to first added
                }
            }

            // Fetch photos with the determined order
            $sql = "SELECT * FROM photos ORDER BY upload_date $sortOrder"; // Ensure 'upload_date' exists
            $result = $conn->query($sql);

            // Check for SQL errors
            if (!$result) {
                die("SQL error: " . $conn->error); // Display error message
            }

            if ($result->num_rows > 0) {
                // Loop through each image and display it
                while ($row = $result->fetch_assoc()) {
                    echo "<img src='" . $row['image_path'] . "' alt='Photo'>";
                    // Debugging line
                    echo "<!-- Debug: " . $row['image_path'] . " -->";
                }
            } else {
                echo "No photos available.";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
