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
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  margin-top: 100px;
}
</style>
<body>
<section id="content">
   <main>
			<h1 class="title">PURCHASE DETAILS</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">INFO</a></li>
			</ul>
            <?Php
                                
                if (isset($_GET['purchase_invoice'])) {
                    $purchaseInvoice = $_GET['purchase_invoice'];
            ?>
 
                 <?php
                $sql = "SELECT p.product_name, q.quantity,
                    p.price,q.purchase_date,
                    q.quantity * p.price AS total_price FROM product p JOIN purchase q ON p.product_id = q.product_id WHERE q.purchase_invoice = '$purchaseInvoice'";

            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    // Display the details in a table
                   
                    echo "<h2>Purchase Details for Invoice: $purchaseInvoice</h2>";
                   
                    echo "<table border='1' style=width:100%;>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['product_name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['total_price']}</td>
                            </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>No details found for the given purchase invoice.</p>";
                }
            } else {
                echo "Error: " . $conn->error;
            }
            } else {
            echo "<p>No purchase invoice provided.</p>";
            }

            // Close the connection
            $conn->close();
            ?>
            
      </main>
</section>    
</body>
</html>




   


