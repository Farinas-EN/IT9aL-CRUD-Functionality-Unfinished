<?php
// Include database connection
include "database.php";

// Check if the task ID is passed
if (isset($_GET['id'])) {
  $task_id = $_GET['id'];

  // Delete the task from the database
  $query = "DELETE FROM todo WHERE ID = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $task_id);
  $stmt->execute();

  // Redirect back to the main dashboard after deleting the task
  header("Location: MainDashboard.php");
  exit;
} else {
  echo "Task ID not specified.";
  exit;
}
?>
