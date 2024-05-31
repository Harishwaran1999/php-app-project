<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
</head>
<body>
    <h1>Bookstore</h1>

    <?php
    // Database connection parameters
    $host = 'localhost'; // Change this if your database is hosted elsewhere
    $username = 'your_username'; // Replace with your MySQL username
    $password = 'your_password'; // Replace with your MySQL password
    $database = 'bookstore'; // Replace with your database name

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to retrieve books from the 'books' table
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>Title: " . $row["title"]. " - Author: " . $row["author"]. " - Published Year: " . $row["published_year"]. "</li>";
        }
        echo "</ul>";
    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
