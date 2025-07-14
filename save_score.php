<?php
// save_score.php

header('Content-Type: application/json');

// Database connection
$host = "localhost";
$dbname = "quiz_app";
$user = "root";
$pass = ""; // change if needed

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(["error" => "Database connection failed"]);
  exit();
}

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

$username = $conn->real_escape_string($data['username']);
$subject = $conn->real_escape_string($data['subject']);
$score = (int)$data['score'];

// Insert score
$sql = "INSERT INTO scores (username, subject, score) VALUES ('$username', '$subject', $score)";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["message" => "Score saved successfully"]);
} else {
  http_response_code(500);
  echo json_encode(["error" => "Error saving score: " . $conn->error]);
}

$conn->close();
?>
