<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Admin login check (hardcoded)
    if ($email === "admin" && $password === "admin123") {
        $_SESSION['username'] = "admin";
        header("Location: admin.html");
        exit();
    }

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // User found
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: home.html");
            exit();
        } else {
            echo "<script>alert('Invalid password.'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('User not found.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    // If accessed directly
    header("Location: login.html");
    exit();
}
?>
