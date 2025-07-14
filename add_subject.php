<?php
$conn = new mysqli("localhost", "root", "", "quiz_app");
$title = $_POST['title'];
$stmt = $conn->prepare("INSERT INTO subjects(title) VALUES(?)");
$stmt->bind_param("s", $title);
if ($stmt->execute()) {
  echo "Subject added successfully!";
} else {
  echo "Error adding subject.";
}
?>
