<?php
// Include database connection
include "database.php";

// Check if the task ID is passed
if (isset($_GET['id'])) {
  $task_id = $_GET['id'];

  // Fetch the task data from the database
  $query = "SELECT * FROM todo WHERE ID = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $task_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $task = $result->fetch_assoc();
  } else {
    echo "Task not found.";
    exit;
  }

  // Check if the form is submitted for updating the task
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    // Update the task in the database
    $update_query = "UPDATE todo SET name = ?, type = ?, status = ? WHERE ID = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssii", $name, $type, $status, $task_id);
    $stmt->execute();

    // Redirect back to the main dashboard after updating the task
    header("Location: MainDashboard.php");
    exit;
  }
} else {
  echo "Task ID not specified.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Task</title>
</head>
<body>
  <h3>Update Task</h3>
  <form method="POST" action="UpdateHandler.php?id=<?= $task['ID']; ?>">
    <label for="name">Task Name:</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($task['name']); ?>" required><br><br>

    <label for="type">Task Type:</label>
    <input type="text" id="type" name="type" value="<?= htmlspecialchars($task['type']); ?>" required><br><br>

    <label for="status">Task Status:</label>
    <select id="status" name="status" required>
      <option value="0" <?= $task['status'] == 0 ? 'selected' : ''; ?>>Ongoing</option>
      <option value="1" <?= $task['status'] == 1 ? 'selected' : ''; ?>>Completed</option>
    </select><br><br>

    <button type="submit">Update Task</button>
  </form>
</body>
</html>
