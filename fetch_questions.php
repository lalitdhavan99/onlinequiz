<?php
// fetch_questions.php
header('Content-Type: application/json');

// Get the subject_id from the URL
$subject_id = isset($_GET['subject_id']) ? (int)$_GET['subject_id'] : 0;

// Connect to the database
$connection = new mysqli('localhost', 'username', 'password', 'your_database');

// Check connection
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Query to get questions based on subject_id
$sql = "SELECT * FROM questions WHERE subject_id = $subject_id";
$result = $connection->query($sql);

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

echo json_encode($questions);

$connection->close();
?>
