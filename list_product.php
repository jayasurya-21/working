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
			<h1 class="title">PRODUCT INFO</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">LIST PRODUCTS</a></li>
			</ul>
            <?php
             if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // SQL query to retrieve products
            $sql = "SELECT * FROM product";
            $result = $conn->query($sql);
            
            // Check if there are products in the database
            if ($result->num_rows > 0) {
               // echo "<main>";
                 echo"  <table border='3' class='table table-striped table-bordered'>
                    <th>Product Id</th><th>Product Name</th><th>price</th>
                    <th>quantity</th><th>min Qty</th><th>exp_date</th>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["product_id"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>" . $row["min_qty"] . "</td>";
                    echo "<td>" . $row["exp_date"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                //echo "</main>";
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