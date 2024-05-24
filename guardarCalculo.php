<?php
// Database connection
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

// Get data from form
$kilos = $_POST['kilos']; // replace 'kilos' with the actual name of your input field
$conversion = $_POST['conversion'];

// Process data
if ($conversion == 1) {
    // Kilogramos a Libras
    $lb = $kilos * 2.20462;
    $kg = $kilos;
} elseif ($conversion == 2) {
    // Libras a Kilogramos
    $kg = $kilos / 2.20462;
    $lb = $kilos;
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO results (kg, lb) VALUES (?, ?)");
$stmt->bind_param("dd", $kg, $lb);

// Execute SQL statement
if ($stmt->execute()) {
    echo "Calculation saved successfully";
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$conn->close();
?>
