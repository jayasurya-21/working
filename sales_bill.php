<?php
// Start the session
session_start();

// Check if salesInvoiceId exists in the session
if (isset($_SESSION['salesInvoiceId'])) {
    // Retrieve salesInvoiceId from session
    $salesInvoiceId = $_SESSION['salesInvoiceId'];

    // Establish a database connection (replace with your credentials)
    $host = "localhost";
$username = "root";
$password = "";
$database = "ims";

    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch sales invoice details
    $sql = "SELECT * FROM sales_invoice WHERE sales_invoice_id = '$salesInvoiceId'";
    $resultInvoice = $conn->query($sql);
    $salesInvoiceDetails = $resultInvoice->fetch_assoc();

    // Fetch customer details for the given sales invoice
    $sqlCustomer = "SELECT customer.* FROM customer
                    INNER JOIN sales_invoice ON customer.cus_id = sales_invoice.cus_id
                    WHERE sales_invoice.sales_invoice_id = '$salesInvoiceId'";
    $resultCustomer = $conn->query($sqlCustomer);
    $customerDetails = $resultCustomer->fetch_assoc();

    // Fetch sale details for the given sales invoice
    $sqlSale = "SELECT sale.*, product.product_name, product.price AS unit_price FROM sale
                INNER JOIN product ON sale.product_id = product.product_id
                WHERE sale.sales_invoice_id = '$salesInvoiceId'";
    $resultSale = $conn->query($sqlSale);
    $saleDetails = [];
    while ($row = $resultSale->fetch_assoc()) {
        $saleDetails[] = $row;
    }

    // Display bill for the customer
    echo "<h1>Invoice for Sale ID: $salesInvoiceId</h1>";

    if ($customerDetails) {
        echo "<h2>Customer Details</h2>";
        echo "Name: " . $customerDetails['cus_name'] . "<br>";
        echo "Address: " . $customerDetails['cus_add'] . "<br>";
        echo "Email: " . $customerDetails['cus_email'] . "<br>";
        echo "Phone: " . $customerDetails['cus_mob'] . "<br>";
        echo "Gender: " . $customerDetails['cus_gender'] . "<br>";
        echo "GST Number: " . $customerDetails['cus_gstno'] . "<br>";
    }

    if ($salesInvoiceDetails) {
        echo "<h2>Sales Invoice Details</h2>";
        echo "Sales Date: " . $salesInvoiceDetails['sales_date'] . "<br>";
        echo "Total Amount: " . $salesInvoiceDetails['total_amount'] . "<br>";
        echo "Discount: " . $salesInvoiceDetails['discount'] . "<br>";
    }

    if ($saleDetails) {
        echo "<h2>Sale Details</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>";
        foreach ($saleDetails as $sale) {
            echo "<tr>
                    <td>{$sale['product_name']}</td>
                    <td>{$sale['quantity']}</td>
                    <td>{$sale['unit_price']}</td>
                    <td>" . ($sale['quantity'] * $sale['unit_price']) . "</td></tr>";
        }
        echo "</table>";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Sales Invoice ID not found in session.";
}
?>
