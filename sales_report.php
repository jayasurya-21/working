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
			<h1 class="title">SALES REPORT</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">REPORTS</a></li>
			</ul>
         <?php
            $result = null;
$startDate = '';
$endDate = '';

// Check if the search button is clicked
if (isset($_POST['generate_report'])) {
    // Set the start and end dates from the form
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    // SQL query to fetch sales data within the specified date range
    $sql = "SELECT si.sales_invoice_id, c.cus_name, COUNT(s.product_id) AS num_products, si.sales_date, SUM(s.price) AS total_price
            FROM sales_invoice si
            JOIN sale s ON si.sales_invoice_id = s.sales_invoice_id
            JOIN customer c ON si.cus_id = c.cus_id
            WHERE si.sales_date BETWEEN '$startDate' AND '$endDate'
            GROUP BY si.sales_invoice_id, c.cus_name, si.sales_date
            ORDER BY si.sales_date DESC";

    $result = $conn->query($sql);
} else {
    // Fetch all sales data unconditionally
    $sql = "SELECT si.sales_invoice_id, c.cus_name, COUNT(s.product_id) AS num_products, si.sales_date, SUM(s.price* s.quantity)- si.discount AS total_price
            FROM sales_invoice si
            JOIN sale s ON si.sales_invoice_id = s.sales_invoice_id
            JOIN customer c ON si.cus_id = c.cus_id
            GROUP BY si.sales_invoice_id, c.cus_name, si.sales_date
            ORDER BY si.sales_date DESC";

    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<body>

  <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
       
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
                    label {
                display: inline-block;
                width: 100px; /* Adjust the width as needed */
                margin-bottom: 5px;
            }

            input[type="date"] {
                display: inline-block;
                width: 150px; /* Adjust the width as needed */
                padding: 8px;
                margin-bottom: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            input[type="submit"] {
                display: inline-block;
                padding: 8px;
                margin-bottom: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                background-color: #007bff;
                color: white;
                cursor: pointer;
            }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
            
            <form method="post">
    <div class="form-row align-items-center">
        <div class="col-sm-4 my-1">
            <label for="start_date" class="sr-only">Start Date:</label>
            <input type="date" class="form-control datepicker" id="start_date" name="start_date" placeholder="dd-mm-yyyy" value="<?php echo $startDate; ?>">
        </div>
        <div class="col-sm-4 my-1">
            <label for="end_date" class="sr-only">End Date:</label>
            <input type="date" class="form-control datepicker" id="end_date" name="end_date" placeholder="dd-mm-yyyy" value="<?php echo $endDate; ?>">
        </div>
        <div class="col-auto my-1">
            <button type="submit" name="generate_report" class="btn btn-primary">Generate Report</button>
        </div>
    </div>
</form>


                <?php
                if ($result && $result->num_rows > 0) {
                    echo '<table class="table" border=1>
                            <thead>
                                <tr>
                                    <th>Sales Invoice No.</th>
                                    <th>Customer Name</th>
                                    <th>No of Products</th>
                                    <th>Sales Date</th>
                                    <th>Amount Payed</th>
                                </tr>
                            </thead>
                            <tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                
                                <td><a href='sales_details.php?sales_invoice={$row['sales_invoice_id']}'>{$row['sales_invoice_id']}</a></td>
                                <td>{$row['cus_name']}</td>
                                <td>{$row['num_products']}</td>
                                <td>{$row['sales_date']}</td>
                                <td>{$row['total_price']}</td>
                            </tr>";
                    }

                    echo '</tbody>
                        </table>';
                } else {
                    echo '<p>No results found.</p>';
                }
            ?>
    </div>
</main>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include your datepicker library -->
    <script src="path/to/datepicker.js"></script>
    <script>
        // Initialize datepicker
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            });
        });
    </script>
 

            
      </main>
</section>    
</body>
</html>