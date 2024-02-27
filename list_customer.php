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
			<h1 class="title">CUSTOMERS</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">LIST CUSTOMERS</a></li>
			</ul>
            <?php
                 $sql = "SELECT * FROM customer";
                $result = $conn->query($sql);

                // Check if there are products in the database
                if ($result->num_rows > 0) {
                   
                  
                    echo "<table border='3' class='table table-striped'>
                        <th>customer name</th><th> address</th><th> email</th><th>mobile</th><th>gender</th><th>gst no</th>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["cus_name"] . "</td>";
                        echo "<td>" . $row["cus_add"] . "</td>";
                        echo "<td>" . $row["cus_email"] . "</td>";
                        echo "<td>" . $row["cus_mob"] . "</td>";
                        echo "<td>" . $row["cus_gender"] . "</td>";
                        echo "<td>" . $row["cus_gstno"] . "</td>";

                        echo "</tr>";
                    }
                    echo "</table>";
                    
                } else {
                    echo "No products found in the database.";
                }

                // Close the database connection
                $conn->close();

                ?>

 

            
      </main>
</section>    
</body>
</html>