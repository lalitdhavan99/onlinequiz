<?php
header('Content-Type: application/json');
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'quiz_app';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed']);
    exit;
}

$subject = isset($_GET['subject']) ? $_GET['subject'] : '';
if (empty($subject)) {
    echo json_encode(['error' => 'Missing subject']);
    exit;
}

$stmt = $conn->prepare("SELECT username, score, total, date_taken FROM results WHERE subject = ? ORDER BY score DESC, date_taken ASC LIMIT 10");
$stmt->bind_param("s", $subject);
$stmt->execute();
$result = $stmt->get_result();

$leaders = [];
while ($row = $result->fetch_assoc()) {
    $leaders[] = $row;
}

echo json_encode($leaders);
$conn->close();
?>
