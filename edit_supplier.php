         
         
         
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
       form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    input[type="text"],
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    input[type ="text"]{
        /* Additional styling for text inputs */
        /* Add more styles as needed */
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
<body>
<section id="content">
   <main>
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>

             
        <?php
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
            // SQL query to retrieve supplier details based on ID
            $sql = "SELECT * FROM supplier WHERE sup_id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="update_supplier.php" method="POST">
                    <input type="hidden" name="sup_id" value="<?php echo $row['sup_id']; ?>">
                    Supplier Name: <input type="text" name="sup_name" value="<?php echo $row['sup_name']; ?>"><br>
                    Address: <input type="text" name="sup_add" value="<?php echo $row['sup_add']; ?>"><br>
                    Email: <input type="text" name="sup_email" value="<?php echo $row['sup_email']; ?>"><br>
                    Mobile: <input type="text" name="sup_mob" value="<?php echo $row['sup_mob']; ?>"><br>
                    Category: <input type="text" name="sup_category" value="<?php echo $row['sup_category']; ?>"><br>
                    GST No.: <input type="text" name="sup_gstno" value="<?php echo $row['sup_gstno']; ?>"><br>
                    <input type="submit" value="Update Supplier">
                    
                </form>
              
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Perform the database update operation (your existing update logic)
            
                // Assuming the update process was successful
                // Display a success message
                echo '<div style="color: green;">Supplier updated successfully!</div>';
            }
            
            }  else {
                echo "Supplier not found.";
            }

            // Close the database connection
            $conn->close();
            ?>

        <?php
            } else {
                echo "Invalid supplier ID.";
            }
        ?>

            
      </main>
</section>    
</body>
</html>
         
         
         
     
