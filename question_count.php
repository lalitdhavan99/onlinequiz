<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_app";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to count distinct quiz_id from questions table
$sql = "SELECT COUNT(DISTINCT id) AS total_quizzes FROM questions";
$result = $conn->query($sql);

// Check if query ran successfully
if ($result === false) {
    echo "Error in query: " . $conn->error;
} else {
    $row = $result->fetch_assoc();
    echo $row['total_quizzes'];
}

$conn->close();
?>
