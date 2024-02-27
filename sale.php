
<?php
ob_start(); // Start output buffering
include('dashboard.php');
$host = "localhost";
$username = "root";
$password = "";
$database = "ims";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);
echo "hai";
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "hai conne ted";

if (isset($_POST['submit'])) {
    // Check if the customer ID is provided in the $_POST data
    echo "In post";
    if (isset($_POST['customerSelect'])) {
        $customerId = $_POST['customerSelect']; // Use the existing customer ID
        echo "$customerId is selected";
        
       
    } else {
        // Process customer data
        $cus_name = $_POST['cus_name'];
        $cus_add = $_POST['cus_add'];
        $cus_email = $_POST['cus_email'];
        $cus_mob = $_POST['cus_mob'];
        $cus_gender = $_POST['cus_gender'];
        $cus_gstno = $_POST['cus_gstno'];

        // SQL query to insert data into the 'customer' table
        $sql = "INSERT INTO customer (cus_name, cus_add, cus_email, cus_mob, cus_gender, cus_gstno) 
                VALUES ('$cus_name', '$cus_add', '$cus_email', '$cus_mob', '$cus_gender', '$cus_gstno')";

        if ($conn->query($sql) === TRUE) {
            $customerId = $conn->insert_id; // Get the newly inserted customer ID
        } else {
            echo "Error creating customer: " . $conn->error;
            exit(); // Stop further processing if an error occurs
        }
    }
 

    // Generate a unique sales invoice ID using the current date and a random number
    $salesInvoiceId = date("YmdHis") . rand(1000, 9999);

    // Process sales data
    $salesDate = date("Y-m-d"); // Assuming you want to use the current date as the sales date
    $totalAmount = $_POST['grand_total'];
    $discount = $_POST['discount'];

    // SQL query to insert data into the 'sale_invoice' table
    $sqlSaleInvoice = "INSERT INTO sales_invoice (sales_invoice_id, cus_id, sales_date, total_amount, discount) 
                       VALUES ('$salesInvoiceId', '$customerId', '$salesDate', '$totalAmount', '$discount')";
    // Start a session to store the invoice data
    session_start();

// Store the invoice data in a session variable
    $_SESSION['salesInvoiceId'] = $salesInvoiceId;
    if ($conn->query($sqlSaleInvoice) === TRUE) {
        // Process sales product data
        foreach ($_POST['product'] as $key => $productId) {
            $quantity = $_POST['quantity'][$key];
            $price = $_POST['sales_price'][$key];

            // SQL query to insert data into the 'sale' table
            $sqlSale = "INSERT INTO sale (sales_invoice_id, product_id, quantity, price) 
                        VALUES ('$salesInvoiceId', '$productId', '$quantity', '$price')";

            $conn->query($sqlSale); // Insert sales product data
        }

        // Additional processing if needed

       
        $updateProductQuantity = "UPDATE product SET quantity = quantity - $quantity WHERE product_id = $productId";
        $conn->query($updateProductQuantity);
        // echo "<script>alert('Invoice created successfully!');</script>";
        if($conn){
            header("Location: sales_bill_temp.php");
        }
        

    } else {
        echo "Error creating sales invoice: " . $conn->error;
    }
    
}


// Fetch products from the database
$sqlProducts = "SELECT * FROM product";
$resultProducts = $conn->query($sqlProducts);

$sqlCustomers = "SELECT * FROM customer";
$resultCustomer = $conn->query($sqlCustomers);
ob_end_flush(); // Flush the output buffer and turn off output buffering
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->
</head>

<body>
<style>

    /* Style for the entire page */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

/* Header styles */
.text-center {
    text-align: center;
}

/* Table styles */
.table {
    width: 100%;
    margin-bottom: 20px;
}

/* Form input styles */
.form-control {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
}

/* Button styles */
.btn {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    color: #fff;
}

.btn-success {
    background-color: #28a745;
}

.btn-danger {
    background-color: #dc3545;
}

.btn-primary {
    background-color: #007bff;
}

/* Customer information styles */
#customerSelectContainer {
    margin-bottom: 20px;
}

/* Additional styles */
.row {
    margin-bottom: 20px;
}

/* Show/hide form button style */
#showFormBtn {
    display: block;
    margin-bottom: 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
}

/* Form styles */
/* #myForm {
    /* display: none; */
/* } */ 

/* Form input labels */
.control-label {
    margin-bottom: 5px;
    font-weight: bold;
}

/* Styling for red asterisks on required fields */
span[style="color:red;"] {
    font-weight: bold;
    color: red;
    margin-left: 3px;
}

/* Error/info messages */
.error-message {
    color: red;
    margin-top: 5px;
    font-size: 14px;
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
<section id="content">
   <main>
			<h1 class="title">NEW SALE</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">SALES</a></li>
			</ul>
    
        <form class="invoice-form"  method="post">
            <table class="table" id="productsTable">
                <thead>
                    <tr>
                        <th>Select Product</th>
                        <th>Quantity</th>
                        <th>Sales Price</th>
                        <th>Total Price</th>
                    
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Initial row for product details -->
                    <tr>
                        <td>
                            <select class="form-control product-select" name="product[]">
                            <option value="" disabled selected>Select Product</option>
                                <?php
                                if ($resultProducts->num_rows > 0) {
                                    while ($products = $resultProducts->fetch_assoc()) {
                                        $productName = $products['product_name'];
                                        $brand = $products['brand'];
                                        $category = $products['category'];
                                        $quantity = $products['quantity']; // Assuming your quantity column name is 'quantity'
                                        $salesPrice = $products['price']; // Assuming your sales price column name is 'sales_price'
                                        echo "<option value='{$products['product_id']}' data-quantity='{$quantity}' data-sales-price='{$salesPrice}'>{$productName} - {$brand} - {$category}</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No products available</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><input type="number" class="form-control quantity" name="quantity[]">
                            <p class="quantity-info"></p>
                        </td>
                        <td><input type="number"  class="form-control sales-price" name="sales_price[]" >
                        <p class="sales-price-info"></p>
                    </td>
                        <td><input type="text" class="form-control total-price" name="total_price[]"></td>
                        <!-- <td><span class="remaining-quantity"></span></td> -->
                        <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                    </tr>
                </tbody>
            </table>
            <table class="table" id="Table">
                <tr><button type="button" class="btn btn-success mt-3" id="addRow">Add Product</button>
                <tr>
                <tr>
                    <th>Payment</th>
                    <th><input type="number" class="form-control payment" name="payment" id="payment"></th>
                </tr>
                <tr>
                    <th>Discount:</th>
                    <th><input type="number" class="form-control discount" name="discount" id="discount"></th>
                </tr>
                <tr>
                    <th>Grand Total:</th>
                    <th><input type="number" class="form-control grand total" name="grand_total" id="grand_total"></th>
                </tr>
                <tr>
                    <!-- <th>Total Payment:</th>
    <th><input type="number" class="form-control total-payment" name="total_payment" readonly></th> -->
                </tr>
            </table>

            <div class="row">
                <div class="col-md-6">
                    <h4 class="mt-4">Customer Information</h4>
                    <div class="form-group" id="customerSelectContainer">
                        <label for="customerSelect">Select Customer:</label>
                        <select class="form-control" id="customerSelect" name="customerSelect">
                        <option value=""  selected>Select Customer</option>
                           <?php
                            $connc = new mysqli($host, $username, $password, $database);
                            $sqlCustomers = "SELECT * FROM customer";
                            $resultCustomer = $connc->query($sqlCustomers);
                            if ($resultCustomer->num_rows > 0) {
                                while ($customers = $resultCustomer->fetch_assoc()) {
                                    $customerName = $customers['cus_name'];
                                    $mobile = $customers['cus_mob'];
                                    $email = $customers['cus_email'];

                                    echo "<option value='{$customers['cus_id']}'}'>{$customerName} - {$mobile} - {$email}</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No Customer available</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- <button onclick="toggleForm()">Add New Customer</button> -->
                <button type="button"  class="btn btn-primary mt-3" onclick="toggleForm()">Add New Customer</button>

                <div id="myForm" style="display:none;">
                        <!-- <input name="_token" type="hidden" value=""> -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group clear">
                                    <label class="control-label clear">Name<span style="color:red;">*</span></label>
                                    <input class="form-control" name="cus_name" type="text" value="">
                                </div>
                                <div class="form-group clear">
                                    <label class="control-label clear">Address<span style="color:red;">*</span></label>
                                    <textarea class="form-control" rows="3"  name="cus_add" cols="50"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label clear"> Gender</label>
                                    <select id="gender" class="form-control" name="cus_gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group clear">
                                    <label class="control-label clear">GST No</label>
                                    <input class="form-control" name="cus_gstno" type="text" value="">
                                </div>
                                <div class="form-group clear">
                                    <label class="control-label clear">Email</label>
                                    <input class="form-control" name="cus_email" type="email" value="">
                                </div>
                                <div class="form-group clear">
                                    <label class="control-label clear">Mobile<span style="color:red;">*</span></label>
                                    <input class="form-control"  name="cus_mob" type="text" value="">
                                </div>
                            </div>
                        </div>
                </div>

            <!-- Add a submit button to generate the invoice -->
            <button type="submit" name="submit" class="btn btn-primary mt-3">Generate Invoice</button>
    
    </div>
        </form>

       <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
       <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to calculate total price based on quantity, sales price, and discount
        function calculateTotalPrice(row) {
            var quantity = row.find('.quantity').val();
            var salesPrice = row.find('.sales-price').val();
            var finalTotal = quantity * salesPrice;
            row.find('.total-price').val(finalTotal.toFixed(2));

            var totalBeforeDiscount = 0;
            var grand_total = 0;
            var discountValue = 0;

            $('.total-price').each(function() {
                totalBeforeDiscount += parseFloat($(this).val()) || 0;
                $('#payment').val(totalBeforeDiscount);

            });



            // Set the calculated total before discount to the payment field
            $('#payment').val(totalBeforeDiscount.toFixed(2));

            // Get the discount value entered by the user
            var discountValue = parseFloat($('#discount').val()) || 0;

            // Calculate the grand total based on the discount
            var grandTotal = totalBeforeDiscount - discountValue;

            // Set the calculated grand total value to the grand_total input field
            $('#grand_total').val(grandTotal.toFixed(2));
        }

        // Event listener for the discount input field
        $('#discount').on('input', function() {
            calculateTotalPrice($('#productsTable tbody tr:first'));
        });

       

        // Function to update remaining quantity based on product selection
        // function updateRemainingQuantity(row) {
        //     var selectedProduct = row.find('.product-select').val();
        //     // Assume remaining quantity is fetched from the server based on the selected product
        //     var remainingQuantity = getRemainingQuantityFromServer(selectedProduct);
        //     row.find('.remaining-quantity').text(remainingQuantity);
        // }

        // Function to get remaining quantity from the server (replace with actual logic)
        // function getRemainingQuantityFromServer(selectedProduct) {
        //     // Replace this with your logic to fetch remaining quantity from the server
        //     // For now, using a hardcoded value as an example
        //     return 100;
        // }

        // Add new row when the "Add Product" button is clicked
        $('#addRow').on('click', function() {
            var newRow = $('#productsTable tbody tr:first').clone();
            newRow.find('input').val(''); // Clear input values in the new row
            newRow.find('.remaining-quantity').text(''); // Clear remaining quantity in the new row
            newRow.find('select').prop('selectedIndex', 0); // Reset product selection
            $('#productsTable tbody').append(newRow);
        });

        // Remove row when the "Remove" button is clicked
        $('#productsTable').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            updateTotalPrice();
        });

        // Update total price when quantity, sales price, or discount changes
        $('#productsTable').on('input', '.quantity, .sales-price, .discount', function() {
            var row = $(this).closest('tr');
            calculateTotalPrice(row);
            updateTotalPrice();
        });

        // Update remaining quantity when product selection changes
        $('#productsTable').on('change', '.product-select', function() {
            var row = $(this).closest('tr');
            updateProductDetails(row, $(this));
        });

        // Function to update product details when product selection changes
        function updateProductDetails(row, productSelect) {
            var selectedOption = productSelect.find('option:selected');

            var quantityInfo = selectedOption.data('quantity');
            var salesPrice = selectedOption.data('sales-price');

            // Update quantity info and sales price in the row
            row.find('.quantity-info').text("Total Quantity: " + quantityInfo.toFixed(2));
            // row.find('.sales-price').val(salesPrice);
            row.find('.sales-price-info').text("Purchased Price: " + salesPrice.toFixed(2)); // Update sales price info

            // Trigger recalculation of total price and update remaining quantity
            calculateTotalPrice(row);
            // updateRemainingQuantity(row);
        }

        // Save selected customer when the "Save Customer" button is clicked
      //  $('#saveCustomer').on('click', function() {
      //      var selectedCustomer = $('#customerSelect option:selected').text();
      //      $('#selectedCustomer').text(selectedCustomer);
      //      $('#customerModal').modal('hide');
      //  });


        function toggleForm() {
            var form = document.getElementById("myForm");
            form.style.display = (form.style.display === "none") ? "block" : "none";

            
        }
    </script>

</body>

</html>