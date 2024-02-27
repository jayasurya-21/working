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
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  table th,
  table td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tr:hover {
    background-color: #f1f1f1;
  }
</style>
<body>
<section id="content">
   <main>
			<h1 class="title">EXPIRING PRODUCTS</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">EXPIRING</a></li>
			</ul>
            <?php
// Assuming you've established a database connection
// Fetch expiring products within 10 days
                $today = date("Y-m-d");
                $tenDaysLater = date("Y-m-d", strtotime("+10 days"));

                $expiringQuery = "SELECT * FROM product WHERE exp_date BETWEEN '$today' AND '$tenDaysLater'";
                $expiringResult = mysqli_query($conn, $expiringQuery);

                // Fetch expired products
                $expiredQuery = "SELECT * FROM product WHERE exp_date < '$today'";
                $expiredResult = mysqli_query($conn, $expiredQuery);
                ?>

                <!-- Display expiring products within 10 days -->
                <h2>Expiring Products Within 10 Days</h2>
                <table>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Min Qty</th>
                    <th>Exp. Date</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($expiringResult)) : ?>
                    <tr>
                    <td><?php echo $row["product_id"]; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td><?php echo $row["min_qty"]; ?></td>
                    <td><?php echo $row["exp_date"]; ?></td>
                    </tr>
                <?php endwhile; ?>
                </table>

                <!-- Display expired products -->
                <h2>Expired Products</h2>
                <table>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Min Qty</th>
                    <th>Exp. Date</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($expiredResult)) : ?>
                    <tr>
                    <td><?php echo $row["product_id"]; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td><?php echo $row["min_qty"]; ?></td>
                    <td><?php echo $row["exp_date"]; ?></td>
                    </tr>
                <?php endwhile; ?>
                </table>


 

            
      </main>
</section>    
</body>
</html>