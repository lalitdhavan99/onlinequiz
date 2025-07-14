<?php
$conn = new mysqli("localhost", "root", "", "quiz_app");
$result = $conn->query("SELECT * FROM subjects");
$quizzes = [];
while($row = $result->fetch_assoc()) {
  $quizzes[] = $row;
}
echo json_encode($quizzes);
?>
