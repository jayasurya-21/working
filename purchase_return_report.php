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
			<h1 class="title">PURCHASE RETURN REPORT</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active"> REPORTS</a></li>
			</ul>
            <?php
            $sql = "SELECT purchase_return.purchase_return_id, purchase_return.purchase_invoice, purchase_return.product_id, 
               purchase_return.return_quantity, purchase_return.return_reason, purchase_return.return_date,
               product.product_name, product.category, product.brand
        FROM purchase_return
        INNER JOIN product ON purchase_return.product_id = product.product_id ORDER BY  purchase_return.purchase_return_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<style>
        /* Basic styling for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Optional: Styling for heading and content alignment */
        h2 {
            text-align: center;
        }

        p {
            text-align: center;
            color: #666666;
        }
    </style>


    <?php if ($result->num_rows > 0) { ?>
        <table border='1'>
            <tr>
                <th>Return ID</th>
                <th>Purchase Invoice</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Return Quantity</th>
                <th>Return Reason</th>
                <th>Return Date</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['purchase_return_id'] ?></td>
                    <td><?= $row['purchase_invoice'] ?></td>
                    <td><?= $row['product_name'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['brand'] ?></td>
                    <td><?= $row['return_quantity'] ?></td>
                    <td><?= $row['return_reason'] ?></td>
                    <td><?= $row['return_date'] ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No purchase return records found.</p>
    <?php } ?>

</body>

</html>

<?php
// Closing the connection
$conn->close();
?>

 

            
      </main>
</section>    
</body>
</html>

