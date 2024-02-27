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
			<h1 class="title">SALES INFORMATION</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">INFO</a></li>
			</ul>
           <?php
            if (isset($_GET['sales_invoice'])) {
    $salesInvoiceId = $_GET['sales_invoice'];

    // Fetch sales details for the specified sales invoice
    $sql = "SELECT p.product_name, s.quantity, s.price, s.quantity * s.price AS total_price
            FROM sale s
            JOIN product p ON s.product_id = p.product_id
            WHERE s.sales_invoice_id = '$salesInvoiceId'";
    
    
    

// $sql = "SELECT p.product_name, s.quantity, s.price, s.quantity * s.price AS total_price
// FROM sale s
// JOIN product p ON s.product_id = p.product_id
// LEFT JOIN sales_return sr ON s.sale_id = sr.sale_id
// WHERE s.sales_invoice_id = '$salesInvoiceId' AND s.return_status = 0;";


    $result = $conn->query($sql);

    $discountsql=
    "SELECT 
        discount
    FROM 
        sales_invoice
    WHERE 
        sales_invoice_id = '$salesInvoiceId'";
    $discountResult = $conn->query($discountsql);
    if ($discountResult && $discountResult->num_rows > 0) {
        $discountData = $discountResult->fetch_assoc();
        $discount = $discountData['discount'];
    }


    $totalAmountSql = "SELECT 
    total_amount
FROM 
    sales_invoice
WHERE 
    sales_invoice_id = '$salesInvoiceId'";
$totalAmountResult = $conn->query($totalAmountSql);

if ($totalAmountResult && $totalAmountResult->num_rows > 0) {
$totalAmountData = $totalAmountResult->fetch_assoc();
$totalAmount = $totalAmountData['total_amount'];
}













    // Fetch sales invoice information
    $sqlInvoiceInfo = "SELECT c.cus_name, si.sales_date
                       FROM sales_invoice si
                       JOIN customer c ON si.cus_id = c.cus_id
                       WHERE si.sales_invoice_id = '$salesInvoiceId'";
    $resultInvoiceInfo = $conn->query($sqlInvoiceInfo);

    if ($resultInvoiceInfo && $resultInvoiceInfo->num_rows > 0) {
        $invoiceInfo = $resultInvoiceInfo->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->
</head>

<body>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
    <div class="container">
        <h1 class="text-center mt-3">Sales Details</h1>

        <?php
        if (isset($invoiceInfo)) {
            echo "<p>Sales Details for Invoice: {$salesInvoiceId}</p>";
            echo "<p>Customer Name: {$invoiceInfo['cus_name']}</p>";
            echo "<p>Sales Date: {$invoiceInfo['sales_date']}</p>";

            if ($result && $result->num_rows > 0) {
                echo '<table class="table" border="1" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['product_name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['total_price']}</td>
                        </tr>";
                }
                echo "<tr>Discount:{$discount}</tr>";
                echo "<br><br>";
                echo "<tr>Total Amount:{$totalAmount}</tr>";
                echo "<br><br>";
                echo '</tbody>
                    </table>';
            } else {
                echo '<p>No sales details found for the specified invoice.</p>';
            }
        } else {
            echo '<p>Invalid sales invoice ID.</p>';
        }
        ?>

        <p><a href="sales_report.php">Back to Sales Report</a></p>
    </div>
 

            
      </main>
</section>    
</body>
</html>