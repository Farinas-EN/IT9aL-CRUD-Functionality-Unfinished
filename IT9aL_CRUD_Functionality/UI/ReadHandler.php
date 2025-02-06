<?php
// Include database connection
include "database.php";

// Fetch tasks from the database
$query = "SELECT * FROM todo";
$result = $conn->query($query);

// Display tasks
echo "<h3>Task List</h3>";
echo "<table border='1'>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>";

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['ID']}</td>
            <td>{$row['name']}</td>
            <td>{$row['type']}</td>
            <td>" . ($row['status'] == 0 ? "Ongoing" : "Completed") . "</td>
            <td><a href='UpdateHandler.php?id={$row['ID']}'>Edit</a> | 
                <a href='DeleteHandler.php?id={$row['ID']}'>Delete</a></td>
          </tr>";
  }
} else {
  echo "<tr><td colspan='5'>No tasks found.</td></tr>";
}

echo "</table>";
?>
