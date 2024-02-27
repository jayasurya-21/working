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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $sup_id = $_POST['sup_id'];
    $sup_name = $_POST['sup_name'];
    $sup_add = $_POST['sup_add'];
    $sup_email = $_POST['sup_email'];
    $sup_mob = $_POST['sup_mob'];
    $sup_category = $_POST['sup_category'];
    $sup_gstno = $_POST['sup_gstno'];

    // SQL query to update supplier details
    $sql = "UPDATE supplier SET sup_name = '$sup_name', sup_add = '$sup_add', sup_email = '$sup_email', 
            sup_mob = '$sup_mob', sup_category = '$sup_category', sup_gstno = '$sup_gstno' WHERE sup_id = $sup_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the update page after successful update
        header("Location: edit_supplier.php?id=" . $sup_id); // Redirect to the update page for the same supplier
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
