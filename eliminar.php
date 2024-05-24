<?php
$servername = "localhost";
$username = "root";
$password = "Admin1234";
$database = "conversor";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the ID of the row to delete
  $id = $_POST['id'];

  // Prepare the SQL statement
  $sql = "DELETE FROM results WHERE id = ?";

  // Initialize the statement
  $stmt = $conn->prepare($sql);

  // Bind the parameters
  $stmt->bind_param("i", $id);

  // Execute the statement
  if ($stmt->execute()) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }

  // Close the statement
  $stmt->close();
}

// Close the connection
$conn->close();

// Redirect back to the main page
header("Location: index.php");
exit();
?>
