<?php
$servername = "localhost";
$username = "ewatermonitor";
$password = "ewatermonitor";
$dbname = "ewatermonitor";

// Get the values from the URL parameters
$id = $_GET['ID'];
$pressure = $_GET['Pressure'];
$active = $_GET['Active'];

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID exists in the database
$stmt = $conn->prepare("SELECT COUNT(*) FROM your_table_name WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    // Update the existing row
    $stmt = $conn->prepare("UPDATE your_table_name SET pressure = ?, active = ? WHERE id = ?");
    $stmt->bind_param("dss", $pressure, $active, $id);
    $stmt->execute();
    $stmt->close();

    // Check pressure and update status if necessary
    if ($pressure < 1.0) {
        $stmt = $conn->prepare("UPDATE your_table_name SET status = 0 WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
    }
} else {
    // Insert a new row
    $status = ($pressure < 1.0) ? 0 : 1; // Determine initial status based on pressure
    $stmt = $conn->prepare("INSERT INTO your_table_name (id, pressure, active, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdsi", $id, $pressure, $active, $status);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

