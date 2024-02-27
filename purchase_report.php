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
			<h1 class="title">PURCHASE REPORT</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">REPORTS</a></li>
			</ul>
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
       
</head>
<body>
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <h2>Purchase Report</h2>

    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "ims";

    // Create a connection to the database
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch suppliers from the database
    $sqlSuppliers = "SELECT * FROM supplier";
    $resultSuppliers = $conn->query($sqlSuppliers);


    ?>

    <form action="" method="post">
    <!-- <label for="supplier">Select Supplier:</label>
    <select name="supplier" id="supplier">
    <option value="">All Suppliers</option>
    <?php
    if ($resultSuppliers->num_rows > 0) {
        while ($supplier = $resultSuppliers->fetch_assoc()) {
            $selected = ($isFormSubmitted && $_POST['supplier'] == $supplier['sup_id']) ? "selected" : "";
            echo "<option value='{$supplier['sup_id']}' $selected>{$supplier['sup_name']}</option>";
        }
    } else {
        echo "<option value='' disabled>No suppliers available</option>";
    }
    ?>
</select> -->

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" value="<?php echo $isFormSubmitted ? $_POST['start_date'] : ''; ?>">

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" value="<?php echo $isFormSubmitted ? $_POST['end_date'] : ''; ?>">

    <br>

    <input type="submit" name="generate_report" value="Generate Report">
</form>
<?php



    try {
        // Check if the form is submitted
        $isFormSubmitted = ($_SERVER['REQUEST_METHOD'] === 'POST');

        if ($isFormSubmitted) {
            // Fetch purchase data based on filters
            // $supplierFilter = isset($_POST['supplier']) ? $_POST['supplier'] : "";
            $startDateFilter = isset($_POST['start_date']) ? $_POST['start_date'] : "";
            $endDateFilter = isset($_POST['end_date']) ? $_POST['end_date'] : "";

            $sqlFilters = [];
            if (!empty($startDateFilter)) {
                $sqlFilters[] = "purchase_date >= '$startDateFilter'";
            }
            if (!empty($endDateFilter)) {
                $sqlFilters[] = "purchase_date <= '$endDateFilter'";
            }

            $whereClause = "";
            if (!empty($sqlFilters)) {
                $whereClause = "WHERE " . implode(" AND ", $sqlFilters);
            }

            $sql = "SELECT
                        DISTINCT purchase_invoice AS `Purchase Invoice No.`,p.purchase_date,
                        s.sup_name AS `Supplier Name`,
                        COUNT(product_id) AS `No of Product`,
                        SUM(quantity * purchase_price) AS `Total`
                    FROM
                        purchase p
                        JOIN
                        supplier s ON p.sup_id = s.sup_id
                    $whereClause
                    GROUP BY
                        purchase_invoice";

            $result = $conn->query($sql);

            if (!$result) {
                throw new Exception("Error in SQL query: " . $conn->error);
            }

            if ($result->num_rows > 0) {
                echo "<h3>Filtered Results</h3>";
                echo "<table>";
                echo "<tr>
                        <th>Purchase Invoice No.</th>
                        <th>Supplier Name</th>
                        <th>No of Product</th>
                        <th>purchase date</th>
                        <th>Total</th>
                    </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                         
                         <td><a href='purchase_details.php?purchase_invoice={$row['Purchase Invoice No.']}'>{$row['Purchase Invoice No.']}</a></td>
                            <td>{$row['Supplier Name']}</td>
                            <td>{$row['No of Product']}</td>
                            <td>{$row['purchase_date']}</td>
                            <td>{$row['Total']}</td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "<table>";
                echo "<tr>
                        <th>Purchase Invoice No.</th>
                        <th>Supplier Name</th>
                        <th>No of Product</th>
                        <th>purchase date</th>
                        <th>Total</th>
                    </tr>
                <tr> <td colspan='3'><p>No filtered results found.</p></td></tr>";
            }
        } else {
            // Fetch all purchase data initially
            // $sqlAllResults = "SELECT
            //                     DISTINCT purchase_invoice AS `Purchase Invoice No.`,p.purchase_date,
            //                     s.sup_name AS `Supplier Name`,
            //                     COUNT(product_id) AS `No of Product`,
            //                     SUM(quantity * pr.price) AS `Total`
            //                 FROM
            //                     purchase p
            //                     JOIN
            //                     supplier s ON p.sup_id = s.sup_id
            //                     JOIN
            //                      product pr ON p.product_id = pr.product_id
            //                 GROUP BY
            //                     purchase_invoice";
                             $sqlAllResults =   "SELECT
                                DISTINCT p.purchase_invoice AS `Purchase Invoice No.`,
                                p.purchase_date,
                                s.sup_name AS `Supplier Name`,
                                COUNT(p.product_id) AS `No of Product`,
                                SUM(p.quantity * pr.price) AS `Total`
                            FROM
                                purchase p
                            JOIN
                                supplier s ON p.sup_id = s.sup_id
                            JOIN
                                product pr ON p.product_id = pr.product_id
                            GROUP BY
                                p.purchase_invoice ORDER BY P.purchase_id DESC
                            ";

            $resultAllResults = $conn->query($sqlAllResults);

            if (!$resultAllResults) {
                throw new Exception("Error in SQL query: " . $conn->error);
            }

            if ($resultAllResults->num_rows > 0) {
                echo "<h3>All Results</h3>";
                echo "<table>";
                echo "<tr>
                        <th>Purchase Invoice No.</th>
                        <th>Supplier Name</th>
                        <th>No of Product</th>
                        <th>purchase date</th>
                        <th>Total</th>
                    </tr>";

                while ($row = $resultAllResults->fetch_assoc()) {
                    echo "<tr>
                            
                            <td><a href='purchase_details.php?purchase_invoice={$row['Purchase Invoice No.']}'>{$row['Purchase Invoice No.']}</a></td>
                            <td>{$row['Supplier Name']}</td>
                            <td>{$row['No of Product']}</td>
                            <td>{$row['purchase_date']}</td>
                            <td>{$row['Total']}</td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No results found.</p>";
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the connection
        $conn->close();
    }
    ?>


 

            
      </main>
</section>    
</body>
</html>