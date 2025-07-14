<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'quiz_app';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM questions WHERE id = $id");
    // Since this is loaded dynamically, better to return a status than redirect
    echo json_encode(['status' => 'success']);
    exit();
}

$sql = "SELECT questions.*, quizzes.title AS subject 
        FROM questions 
        JOIN quizzes ON questions.quiz_id = quizzes.id 
        ORDER BY questions.id DESC";
$result = $conn->query($sql);
?>

<style>
  .question-table-container {
    border: 1px solid #ccc;
    padding: 15px;
    max-height: 400px; /* limit height for scrolling */
    overflow-y: auto;
    background: #fafafa;
    border-radius: 8px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    font-size: 14px;
  }
  th {
    background-color: #f2f2f2;
  }
  tr:hover {
    background-color: #e9f5ff;
  }
  .delete-btn {
    padding: 5px 10px;
    background-color: #d9534f;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  .delete-btn:hover {
    background-color: #c9302c;
  }
</style>

<div class="question-table-container">
  <table>
      <tr>
          <th>ID</th>
          <th>Subject</th>
          <th>Question</th>
          <th>Option A</th>
          <th>Option B</th>
          <th>Option C</th>
          <th>Option D</th>
          <th>Answer</th>
          <th>Action</th>
      </tr>
      <?php if ($result && $result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
          <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['subject']) ?></td>
              <td><?= htmlspecialchars($row['question_text']) ?></td>
              <td><?= htmlspecialchars($row['option_a']) ?></td>
              <td><?= htmlspecialchars($row['option_b']) ?></td>
              <td><?= htmlspecialchars($row['option_c']) ?></td>
              <td><?= htmlspecialchars($row['option_d']) ?></td>
              <td><?= htmlspecialchars($row['correct_option']) ?></td>
              <td>
                  <button class="delete-btn" onclick="deleteQuestion(<?= $row['id'] ?>)">Delete</button>
              </td>
          </tr>
          <?php endwhile; ?>
      <?php else: ?>
          <tr><td colspan="9">No questions found.</td></tr>
      <?php endif; ?>
  </table>
</div>
