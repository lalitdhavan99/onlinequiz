<?php
header('Content-Type: application/json');

// DB Config
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'quiz_app';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Get subject from frontend
$subject = isset($_GET['category']) ? $_GET['category'] : '';
if (empty($subject)) {
    echo json_encode(['error' => 'Missing subject']);
    exit;
}

// Step 1: Get subject ID (case-insensitive)
$stmt = $conn->prepare("SELECT id FROM subjects WHERE LOWER(title) = LOWER(?)");
$stmt->bind_param("s", $subject);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['error' => 'Subject not found']);
    exit;
}
$subjectData = $result->fetch_assoc();
$subject_id = $subjectData['id'];

// Step 2: Get quiz IDs for the subject
$quiz_ids = [];
$quiz_stmt = $conn->prepare("SELECT id FROM quizzes WHERE subject_id = ?");
$quiz_stmt->bind_param("i", $subject_id);
$quiz_stmt->execute();
$quiz_result = $quiz_stmt->get_result();
while ($row = $quiz_result->fetch_assoc()) {
    $quiz_ids[] = $row['id'];
}

if (empty($quiz_ids)) {
    echo json_encode(['error' => 'No quizzes found for this subject']);
    exit;
}

// Step 3: Get questions for all quiz IDs
$placeholders = implode(',', array_fill(0, count($quiz_ids), '?'));
$types = str_repeat('i', count($quiz_ids));
$question_stmt = $conn->prepare("SELECT * FROM questions WHERE quiz_id IN ($placeholders)");
$question_stmt->bind_param($types, ...$quiz_ids);
$question_stmt->execute();
$question_result = $question_stmt->get_result();

$questions = [];
while ($row = $question_result->fetch_assoc()) {
    $questions[] = [
        'question' => $row['question_text'],
        'options' => [
            $row['option_a'],
            $row['option_b'],
            $row['option_c'],
            $row['option_d']
        ],
        'answer' => ord(strtoupper($row['correct_option'])) - ord('A') // A=0, B=1, ...
    ];
}

echo json_encode($questions);
$conn->close();
?>
