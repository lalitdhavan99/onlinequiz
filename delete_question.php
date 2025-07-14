<?php
$conn = new mysqli("localhost", "root", "", "quiz_app");
$id = $_GET['id'];
$conn->query("DELETE FROM questions WHERE id = $id");
?>
