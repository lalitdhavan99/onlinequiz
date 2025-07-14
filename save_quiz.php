<select name="subject_id" required>
  <?php
  include 'db.php';
  $subjects = mysqli_query($conn, "SELECT * FROM subjects");
  while ($row = mysqli_fetch_assoc($subjects)) {
    echo "<option value='{$row['id']}'>{$row['title']}</option>";
  }
  ?>
</select>
