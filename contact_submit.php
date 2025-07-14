<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "quiz_app";

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and retrieve form data
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$message = $conn->real_escape_string($_POST['message']);

// Insert into contact_messages table
$sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    // Optional: Send email notification
    $to = "your-email@example.com";  // change to your email
    $subject = "New Contact Form Message from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: no-reply@yourdomain.com";

    // Uncomment to enable email (make sure mail() is configured)
    // mail($to, $subject, $body, $headers);

    echo "Message received. Thank you!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
