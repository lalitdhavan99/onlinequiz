<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get the quiz_id from the URL
$quiz_id = isset($_GET['quiz_id']) ? (int)$_GET['quiz_id'] : 0;

// Connect to the database
$connection = new mysqli('localhost', 'username', 'password', 'your_database');

// Check connection
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Query to get questions based on quiz_id
$sql = "SELECT * FROM questions WHERE quiz_id = $quiz_id";
$result = $connection->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
    echo json_encode($questions); // Send the questions as JSON
} else {
    echo json_encode([]); // No questions found for this quiz_id
}

$connection->close();
?>
