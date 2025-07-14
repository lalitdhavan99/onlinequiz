<?php
// Database connection details
$servername = "localhost"; // Database server
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "quiz_app"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to count the total number of users
$sql = "SELECT COUNT(*) AS total_users FROM users";
$result = $conn->query($sql);

// Fetch and return the result
if ($result->num_rows > 0) {
    // Output the total user count
    $row = $result->fetch_assoc();
    echo $row['total_users'];
} else {
    // If no users found, return 0
    echo "0";
}

// Close the database connection
$conn->close();
?>
