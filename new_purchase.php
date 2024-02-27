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
body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form [type="submit"] {
            max-width: 600px; 
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label [type="date"] {
            display: block;
            margin-bottom: 5px;
        }

        select,
        input[type="date"],
        input[type="number"],
        button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: 30%;
            color: black;
            background-color: green;
        }
    

        button {
            background-color: #dc3545;
            color: black;
            cursor: pointer;
        }

        button:hover {
            background-color: #c82333;
        }

        .product-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
</style>
<body>
<section id="content">
   <main>
			<h1 class="title">NEW PURCHASE</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="new_purchase.php" class="active">ADD PURCHASE</a></li>
			</ul>
            <?php

                // Fetch products from the database
                $sqlProducts = "SELECT * FROM product";
                $resultProducts = $conn->query($sqlProducts);

                if ($resultProducts->num_rows > 0) {
                    $products = $resultProducts->fetch_all(MYSQLI_ASSOC);
                } else {
                    $products = [];
                }

                // Fetch suppliers from the database
                $sqlSuppliers = "SELECT * FROM supplier";
                $resultSuppliers = $conn->query($sqlSuppliers);

                if ($resultSuppliers->num_rows > 0) {
                    $suppliers = $resultSuppliers->fetch_all(MYSQLI_ASSOC);
                } else {
                    $suppliers = [];
                }

                // Close the connection
                $conn->close();
                ?>

<form action="" method="post">
        <label for="supplier">Select Supplier:</label>
        <select name="supplier" id="supplier" required>
            <?php foreach ($suppliers as $supplier): ?>
                <option value="<?php echo $supplier['sup_id']; ?>"><?php echo $supplier['sup_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>">

       

        <div id="products-container">
            <!-- Dynamic fields will be added here -->
        </div>

        <br>

        <button type="button" onclick="addProductField()">Add Product</button>

        <br>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>

    <script>
    function addProductField() {
        
    const productsContainer = document.getElementById('products-container');

    // Create product select
    const productSelect = document.createElement('select');
    productSelect.name = 'products[]';
    productSelect.required = true;

    <?php foreach ($products as $product): ?>
        {
            const productOption = document.createElement('option');
            productOption.value = '<?php echo $product['product_id']; ?>';
            productOption.textContent = '<?php echo $product['product_name']; ?>';
            productOption.setAttribute('data-price', '<?php echo $product['price']; ?>');
            productOption.setAttribute('data-quantity', '<?php echo $product['quantity']; ?>');
            productSelect.appendChild(productOption);
        }
    <?php endforeach; ?>

    // Create quantity input
    const quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.name = 'quantities[]';
    quantityInput.placeholder = ' add Quantity';
    quantityInput.required = true;

    // Create price input
    // const priceInput = document.createElement('input');
    // priceInput.type = 'number';
    // priceInput.name = 'prices[]';
    // priceInput.placeholder = 'Price';
    // priceInput.required = true;

    // Create original price input
    const originalPriceInput = document.createElement('input');
    originalPriceInput.type = 'text';
    originalPriceInput.name = 'original_prices[]';
    originalPriceInput.placeholder = 'current Price';
    originalPriceInput.readOnly = true;

    // Create original quantity input
    const originalQuantityInput = document.createElement('input');
    originalQuantityInput.type = 'text';
    originalQuantityInput.name = 'original_quantities[]';
    originalQuantityInput.placeholder = 'available Quantity';
    originalQuantityInput.readOnly = true;

    // Create remove button
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.className = 'btn btn-danger bi bi-cake';
    removeButton.innerHTML = 'Remove';
    removeButton.addEventListener('click', function () {
        productsContainer.removeChild(productRow);
    });

    // Create product row
    const productRow = document.createElement('div');
    productRow.className = 'product-row';
    productRow.appendChild(productSelect);
    productRow.appendChild(originalPriceInput);
    productRow.appendChild(originalQuantityInput);
    productRow.appendChild(quantityInput);
    // productRow.appendChild(priceInput);
    productRow.appendChild(removeButton);

    // Create event listener for product select
    productSelect.addEventListener('change', function () {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const originalPrice = selectedOption.getAttribute('data-price');
        const originalQuantity = selectedOption.getAttribute('data-quantity');

        // Update original price and quantity inputs
        originalPriceInput.value = originalPrice;
        originalQuantityInput.value = originalQuantity;
    });

    // Create line break
    const lineBreak = document.createElement('br');

    // Append elements to container
    productsContainer.appendChild(productRow);
    productsContainer.appendChild(lineBreak);
}


</script>

</body>
</html>

<?php
// Include database connection code here

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedSupplier = $_POST['supplier'];
    $purchase_date = $_POST['date'];


    // Generate a unique invoice number
    $invoiceNumber = generateUniqueInvoiceNumber();

    foreach ($_POST['products'] as $key => $product) {
        $selectedProduct = $product;
        $quantity = $_POST['quantities'][$key];
        // $price = $_POST['prices'][$key];
        
        // Insert data into the purchase table with the same invoice number
        $insertQuery = "INSERT INTO purchase (purchase_invoice, sup_id, product_id, quantity, purchase_date) 
                        VALUES ('$invoiceNumber', '$selectedSupplier', '$selectedProduct', '$quantity','$purchase_date')";

        if ($conn->query($insertQuery) !== TRUE) {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }

         // Update the quantity of the selected product in the product table
    $quantityUpdateQuery = "UPDATE product 
                            SET quantity = quantity + '$quantity' 
                            WHERE product_id = '$selectedProduct'";

    if ($conn->query($quantityUpdateQuery) !== TRUE) {
        echo "Error updating product quantity: " . $conn->error;
    }
    }
}

// Close the connection
$conn->close();

function generateUniqueInvoiceNumber() {
    // You can implement your logic to generate a unique invoice number here
    // For example, you can use a combination of date and a random number
    return 'INV' . date('YmdHis') . rand(1000, 9999);
}
?>
 

            
      </main>
</section>    
</body>
</html>