<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "ims";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID parameter exists and is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // SQL DELETE query
    $sql = "DELETE FROM supplier WHERE sup_id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the original page after deletion
        header("Location: add_supplier.php"); // Replace 'index.php' with your actual page name
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
