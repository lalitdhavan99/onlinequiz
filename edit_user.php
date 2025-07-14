<?php
include 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}
?>

<form action="update_user.php" method="POST">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    <input type="text" name="username" value="<?= $user['username'] ?>" required>
    <input type="email" name="email" value="<?= $user['email'] ?>" required>
    <button type="submit">Update</button>
</form>
