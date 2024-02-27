<?php
// Assuming you've connected to your database.
// Replace database_name, username, password, and host with your actual details.
include('dashboard.php');
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "ims";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate if new password matches the confirmation
    if ($new_password !== $confirm_password) {
        echo "New password and confirmation do not match";
        exit();
    }

    // You should validate and sanitize user input before using it in a query to prevent SQL injection.
    // For instance, using prepared statements.

    // Check if old password matches the one in the database (example query)
    // Replace 'users' with your actual table name and 'password_column' with your actual password column name
    $sql = "SELECT * FROM login WHERE password = '$old_password'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Update password if old password matches (example query)
        // Replace 'users' with your actual table name and 'password_column' with your actual password column name
        $update_sql = "UPDATE login SET password = '$new_password' WHERE password = '$old_password'";
        if ($conn->query($update_sql) === TRUE) {
            echo "Password changed successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Old password is incorrect";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label, input {
            display: block;
            margin-bottom: 15px;
        }
        input[type="password"],
        input[type="submit"] {
            width: calc(100% - 30px);
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
    <main class="mt-5 pt-3">
    <div class="container-fluid">
    <h1>Change Password</h1>
    <form action="change_password.php" method="post">
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" required><br><br>
        
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>
        
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        
        <input type="submit" value="Change Password">
    </form>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>
