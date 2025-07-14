<?php
header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'quiz_app';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$category = $data['category'] ?? '';
$score = $data['score'] ?? 0;
$total = $data['total'] ?? 0;
$username = 'guest'; // Replace with session or login info if available
$timestamp = date('Y-m-d H:i:s');

// Get subject ID
$stmt = $conn->prepare("SELECT id FROM subjects WHERE LOWER(title) = LOWER(?)");
$stmt->bind_param("s", $category);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid subject']);
    exit;
}
$subject_id = $res->fetch_assoc()['id'];

// Save result
$save_stmt = $conn->prepare("INSERT INTO results (username, subject_id, score, total_questions, submitted_at) VALUES (?, ?, ?, ?, ?)");
$save_stmt->bind_param("siiis", $username, $subject_id, $score, $total, $timestamp);

if ($save_stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save result']);
}

$conn->close();
?>
