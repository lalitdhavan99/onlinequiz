<?php
include 'db.php';

if (isset($_POST['username'], $_POST['subject'], $_POST['score'])) {
    $username = $_POST['username'];
    $subject = $_POST['subject'];
    $score = $_POST['score'];

    $stmt = $conn->prepare("INSERT INTO results (username, subject, score) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $username, $subject, $score);
    $stmt->execute();

    echo "Result saved securely.";
} else {
    echo "Missing required fields.";
}
?>
