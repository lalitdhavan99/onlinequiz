<?php
include 'db.php';
$result = $conn->query("SELECT * FROM users");

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['username']}</td>
        <td>{$row['email']}</td>
        <td>
            <a href='edit_user.php?id={$row['id']}'>Edit</a> |
            <a href='delete_user.php?id={$row['id']}' onclick='return confirm(\"Delete this user?\")'>Delete</a>
        </td>
    </tr>";
}
echo "</table>";
?>
