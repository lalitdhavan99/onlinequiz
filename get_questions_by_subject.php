<?php
include 'db.php';

$subject = isset($_GET['subject']) ? $_GET['subject'] : '';

if (!$subject) {
    echo json_encode(['error' => 'Subject not provided']);
    exit;
}

$sql = "SELECT * FROM questions WHERE quiz_id = (SELECT id FROM subjects WHERE title = ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $subject);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];

while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

echo json_encode($questions);
$conn->close();
?>
