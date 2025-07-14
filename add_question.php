<?php
$conn = new mysqli("localhost", "root", "", "quiz_app");
$quiz_id = $_POST['quiz_id'];
$question = $_POST['question_text'];
$a = $_POST['option_a'];
$b = $_POST['option_b'];
$c = $_POST['option_c'];
$d = $_POST['option_d'];
$correct = $_POST['correct_option'];
$time = $_POST['time_limit'];

$stmt = $conn->prepare("INSERT INTO questions(quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option, time_limit) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssi", $quiz_id, $question, $a, $b, $c, $d, $correct, $time);

if ($stmt->execute()) {
  echo "Question added successfully!";
} else {
  echo "Failed to add question.";
}
?>
