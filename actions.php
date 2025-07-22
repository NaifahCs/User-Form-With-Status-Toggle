<?php
include 'database.php'; // cannect to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $action = $_POST['action'];
// insert new user 
  if ($action === 'add') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $status = 0; // default status is 0

    $stmt = $conn->prepare("INSERT INTO users (name, age, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $name, $age, $status);

    if ($stmt->execute()) {
      echo "success";
    } else {
      echo "error";
    }
    $stmt->close();
  }
  // fetch all users from database
elseif ($action === 'fetch') {
    $sql = "SELECT * FROM users ORDER BY id ASC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
      $statusClass = ($row['status'] == 1) ? 'status-active' : 'status-inactive' ; // Determine button class based on status value
      echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['age']}</td>
              <td>{$row['status']}</td>
              <td><button class='toggle-btn {$statusClass}' onclick='toggleStatus({$row['id']})'>Toggle</button></td>
            </tr>";
    }
  }

  //Toggle user status between 0 and 1 
  elseif ($action === 'toggle') {
    $id = $_POST['id'];
    $get = $conn->query("SELECT status FROM users WHERE id=$id");
    $data = $get->fetch_assoc();
    $newStatus = ($data['status'] == 1) ? 0 : 1;

    $update = $conn->query("UPDATE users SET status=$newStatus WHERE id=$id");

    if ($update) {
      echo "success";
    } else {
      echo "error";
    }
  }

  // Delete all users
  elseif ($action === 'deleteAll') {
  $deleteAll = $conn->query("DELETE FROM users");

  if ($deleteAll) {
    $conn->query("ALTER TABLE users AUTO_INCREMENT = 1"); // Reset auto-increment counter to 1
    echo "success";
  } else {
    echo "error";
  }
}

  $conn->close();
}
?>