<?php  include 'dashboard.php';?>
<?php  include 'links.php';?>
<?php  include 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* Styles for the table */
    table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 8px;
    text-align: left;
}

 */

table tr:nth-child(even) {
    background-color: #f2f2f2; /* Alternate row background color */
}

/* General styles for the page */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h1.title {
    background-color: blue; /* Set h1 background color to blue */
    color: white; /* Set text color for h1 */
    padding: 10px;
}

ul.breadcrumbs {
    list-style: none;
    padding: 0;
    background-color: #f0f0f0; /* Set breadcrumbs background color */
    margin-top: 10px;
}

ul.breadcrumbs li {
    display: inline-block;
    padding: 5px;
}

ul.breadcrumbs li.divider {
    margin: 0 5px;
    color: #999;
}

ul.breadcrumbs li a {
    text-decoration: none;
    color: blue; /* Set link color for breadcrumbs */
}

ul.breadcrumbs li a.active {
    color: black; /* Set active link color */
    font-weight: bold;
}

</style>
<body>
<section id="content">
   <main>
			<h1 class="title">SUPPLIERS</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">VIEW SUPPLIERS</a></li>
			</ul>
            <?php
             if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
// SQL query to retrieve products
$sql = "SELECT * FROM supplier";
$result = $conn->query($sql);

// Check if there are products in the database
if ($result->num_rows > 0) {
    echo "<main>";
    echo "<h2>SUPPLIER</h2>";
    echo "<table border='3' class='table table-striped'>
        <th>Supplier name</th><th> Address</th><th> Email</th><th>Mobile</th><th>Category</th><th>GST no.</th><th>action</th><th></th>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["sup_name"] . "</td>";
        echo "<td>" . $row["sup_add"] . "</td>";
        echo "<td>" . $row["sup_email"] . "</td>";
        echo "<td>" . $row["sup_mob"] . "</td>";
        echo "<td>" . $row["sup_category"] . "</td>";
        echo "<td>" . $row["sup_gstno"] . "</td>";
// Edit button with a link to the edit page (replace 'edit.php' with your actual edit page)
                    echo "<td ><a href='edit_supplier.php?  id= " . $row["sup_id"] . "'>edit</a></td>";
                    

                    // Delete button with a link to the delete script (replace 'delete.php' with your actual delete script)
                    echo "<td><a href='delete_supplier.php?id=" . $row["sup_id"] . "'>Delete</a></td>";

     
        echo "</tr>";
    }
    echo "</table>";
    echo "</main>";
} else {
    echo "No products found in the database.";
}

// Close the database connection
$conn->close();

?>
</main>
</div>
</body>