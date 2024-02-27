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
			<h1 class="title">Products Below Minimum Quantity</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">LIMIT</a></li>
			</ul>

            <?php
                // SQL query to retrieve products with quantity less than the minimum quantity
                $sql = "SELECT product_id, product_name, quantity, min_qty FROM product WHERE quantity < min_qty";
                $result = $conn->query($sql);
                ?>
                <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <title></title>
                        <style>
                            table {
                                border-collapse: collapse;
                                width: 100%;
                            }

                            th, td {
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: left;
                            }

                            th {
                                background-color: #f2f2f2;
                            }
                        </style>
                    </head>

                    <body>
                    
                        <table>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Minimum Quantity</th>
                            </tr>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row["product_id"] . "</td>
                                            <td>" . $row["product_name"] . "</td>
                                            <td>" . $row["quantity"] . "</td>
                                            <td>" . $row["min_qty"] . "</td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No products found with quantity less than minimum quantity.</td></tr>";
                            }
                            ?>
                        </table>
                    </body>

                    </html>

                    <?php
                    $conn->close();
                    ?>
            
      </main>
</section>    
</body>
</html>




