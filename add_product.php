<?php  include 'dashboard.php';?>
<?php  include 'links.php';?>
<?php  include 'db_connection.php';?>


<?php
// Fetch values from the form
if (isset($_POST['submit'])) {
    $product_date= $_POST['product_date'];
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $quantity = $_POST['quantity'];
    $hsn = $_POST['hsn'];
    $description = $_POST['description'];
    $tax = $_POST['tax'];
    $discount_type = $_POST['discount_type'];
    $min_qty = $_POST['min_qty'];
    $exp_date = $_POST['exp_date'];

    $sql = "INSERT INTO product (product_date, product_name, category, brand, price, unit, quantity, hsn, description, tax, discount_type, min_qty, exp_date) VALUES ('$product_date','$product_name', '$category', '$brand', '$price', '$unit', '$quantity', '$hsn', '$description', '$tax', '$discount_type', '$min_qty', '$exp_date')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <title>Document</title>
</head>
<body>
<style>
.card-body {
    padding: 20px;
}

.form-group {
    margin-bottom: 20px;
}

/* Style the buttons */
.btn {
    margin-right: 10px;
}

/* Style form labels */
label {
    font-weight: bold;
}

/* Adjust the card appearance */
.card {
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Style form inputs and selects */
input[type="text"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

/* Ensure the buttons are aligned */
.btn-group {
    display: flex;
    align-items: center;
    justify-content: flex-end;
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
			<h1 class="title" style="margin: left 10px;">ADD NEW PRODUCT</h1>
			<ul class="breadcrumbs" style="margin: Right 50px;">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="add_product.php" class="active">ADD PRODUCT</a></li>
			</ul>
            <form action="#" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
          <label>Category</label>
          <select class="form-select" name="category">
            <option value="hardware">Hardware</option>
            <option value="PVC">PVC</option>
            <option value="CEMENT">CEMENT</option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
          <label>Expiry Date</label>
          <input type="date" name="exp_date" class="form-control">
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
          <label>Brand</label>
          <select class="form-select" name="brand">
            <option value="asian">Asian</option>
            <option value="htc">HTC</option>
          </select>
        </div>
      </div>
      <br>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
          <label>Unit</label>
          <select class="form-select" name="unit" required>>
            <option value="number">Number</option>
            <option value="kg">Kg</option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
          <label>date</label>
          <input type="date"  value="<?php echo date('Y-m-d'); ?>name="product_date" id =" date" data-variable="Dynamic Value" class="form-control" required>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
          <label>Limit</label>
          <input type="number" name="min_qty" class="form-control">>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
          <label>Quantity</label>
          <input type="text" name="quantity" class="form-control" required>>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" name="description" rows="5"></textarea>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 b-3">
        <div class="form-group">
          <label>Tax</label>
          <select class="form-select" name="tax" required>>
            <option value="18">18%</option>
            <option value="9">9%</option>
          </select>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12">
        <div class="form-group">
          <label>Discount Type</label>
          <select class="form-select" name="discount_type">
            <option value="5">5%</option>
            <option value="10">10%</option>
            <option value="20">20%</option>
          </select>
        </div>
      </div>
       <div class="col-lg-3 col-sm-6 col-12">
            <div class="form-group">
                 <label for="hsn">HSN</label>
                <input type="text" name="hsn" class="form-control" required>>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="form-group">
                <label for="price">price</label>
                <input type="number" name="price" class="form-control" required>>
            </div>
        </div>
                           
        <div class="col-lg-3 col-sm-6 col-12 mt-4">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
        
            
        </div>
     </div>
    </div>
    </form>  
    <script>
        function updateDateTime() {
        const dateElement = document.getElementById("date").getAttribute("data-variable");
        const now = new Date();
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const dateString = now.toLocaleDateString('en-US', dateOptions);
        dateElement.textContent = dateString;
        document.getElementById("product_date").value = dateString;
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
</script>


            
      </main>
</section>    
</body>
</html>