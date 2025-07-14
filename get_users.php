<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "quiz_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Modify the query to match your actual column names
$sql = "SELECT id, username, email FROM users ORDER BY id DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query Failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<h2>Registered Users</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No users found.</p>";
}

$conn->close();
?>
