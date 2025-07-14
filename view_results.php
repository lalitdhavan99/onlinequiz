<?php
require 'db.php';
$result = $conn->query("SELECT * FROM results ORDER BY time_taken DESC");
echo "<table border='1'>
<tr><th>Username</th><th>Category</th><th>Score</th><th>Total</th><th>Time</th></tr>";
while ($row = $result->fetch_assoc()) {
  echo "<tr>
    <td>{$row['username']}</td>
    <td>{$row['category']}</td>
    <td>{$row['score']}</td>
    <td>{$row['total']}</td>
    <td>{$row['time_taken']}</td>
  </tr>";
}
echo "</table>";
$conn->close();
?>
