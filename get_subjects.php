<?php
// get_subjects.php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "quiz_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT subject FROM questions";
$result = $conn->query($sql);

$subjects = [];
while ($row = $result->fetch_assoc()) {
    $subjects[] = $row['subject'];
}

echo json_encode($subjects);
?>
