<?php
// Include database connection
include "database.php";

// Check if the form is submitted for creating a new task
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve the data from the form
  $name = $_POST['name'];
  $type = $_POST['type'];

  // Insert the new task into the database
  $query = "INSERT INTO todo (name, type, status) VALUES (?, ?, 0)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss", $name, $type);
  $stmt->execute();

  // Redirect back to the main dashboard after creating the task
  header("Location: MainDashboard.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Task</title>
</head>
<body>
  <h3>Create a New Task</h3>
  <form method="POST" action="CreateHandler.php">
    <label for="name">Task Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="type">Task Type:</label>
    <input type="text" id="type" name="type" required><br><br>

    <button type="submit">Create Task</button>
  </form>
</body>
</html>
