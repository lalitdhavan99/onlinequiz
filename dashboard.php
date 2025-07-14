<?php
session_start();
include "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Dashboard stats queries
$totalQuizzes = $conn->query("SELECT COUNT(*) as total FROM questions")->fetch_assoc()['total'];
$totalUsers = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$totalScores = $conn->query("SELECT SUM(score) as total FROM results")->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Quiz App - Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <nav>
    <div class="logo-box">
      <img src="logo1.png" alt="Logo" />
    </div>

    <ul class="nav1">
      <li><a href="javascript:void(0);" onclick="toggleSection('aboutSection')">About</a></li>
      <li><a href="javascript:void(0);" onclick="toggleSection('contactSection')">Contact</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="quiz.html"><button class="btn">Get Started</button></a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <div class="welcome-msg">
    Welcome, <strong><?= htmlspecialchars($username) ?></strong>!
  </div>

  <div class="stats-container">
    <div class="stat-box animate">
      <h3>Total Quizzes</h3>
      <p><?= $totalQuizzes ?></p>
    </div>
    <div class="stat-box animate">
      <h3>Registered Users</h3>
      <p><?= $totalUsers ?></p>
    </div>
    <div class="stat-box animate">
      <h3>Total Scores</h3>
      <p><?= $totalScores ?></p>
    </div>
  </div>

  <div id="aboutSection" class="info-box">
    <h2>About</h2>
    <p>This is a fun and educational quiz platform to test your knowledge and grow your skills interactively!</p>
  </div>

  <div id="contactSection" class="info-box">
    <h2>Contact Us</h2>
    <p>📧 support@quizapp.com <br> 📞 +91-12345-67890</p>
  </div>

  <script>
    function toggleSection(id) {
      const box = document.getElementById(id);
      const allBoxes = document.querySelectorAll('.info-box');
      allBoxes.forEach(b => b.style.display = (b.id !== id) ? 'none' : b.style.display);
      box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
    }
  </script>

</body>
</html>
