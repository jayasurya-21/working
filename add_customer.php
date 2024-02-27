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
</style
</style>
<body>
<section id="content">
   <main>
			<h1 class="title">ADD CUSTOMERS</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">NEW CUSTOMERS</a></li>
			</ul>
            <?php
                if (isset($_POST['submit'])) {
                
                $cus_name = $_POST['cus_name'];
                $cus_add= $_POST['cus_add'];
                $cus_email = $_POST['cus_email'];
                $cus_mob = $_POST['cus_mob'];
                $cus_gender = $_POST['cus_gender'];
                $cus_gstno= $_POST['cus_gstno'];
                $cus_due= $_POST['cus_due'];
            

                $sql = "INSERT INTO customer (cus_name, cus_add, cus_email, cus_mob, cus_gender, cus_gstno, cus_due) VALUES ('$cus_name','$cus_add', '$cus_email', '$cus_mob', '$cus_gender', '$cus_gstno', '$cus_due')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Product added successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

          //Close the connection
            $conn->close();
            ?>

        <div class="container-fluid">
        <form method="POST" action="" accept-charset="UTF-8" id="form" enctype="multipart/form-data"><input name="_token" type="hidden" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  clear">
                                    <label class="control-label clear">Name<span style="color:red;">*</span></label>
                                    <input class="form-control" required="required" name="cus_name" type="text" value="">
                                                                    </div> 
                                <div class="form-group  clear">
                                    <label class="control-label clear">Address<span style="color:red;">*</span></label>
                                    <textarea class="form-control" rows="3" required="required" name="cus_add" cols="50"></textarea>
                                                                    </div>
                                <div class="form-group   ">
                                    <label class="control-label clear"> Gender</label>
                                    <select id="gender" class="form-control" name="cus_gender"><option value="male">Male</option><option value="female">Female</option><option value="other">Other</option></select>
                                                                    </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  clear">
                                    <label class="control-label clear">GST No</label>
                                    <input class="form-control" name="cus_gstno" type="text" value="">
                                                                    </div>
                                
                                <div class="form-group  clear">
                                    <label class="control-label clear">Email</label>
                                    <input class="form-control" name="cus_email" type="email" value="">
                                                                    </div>
                                                                    <div class="form-group  clear">
                                    <!-- <label class="control-label clear">Opening Balance(Due)</label>
                                    <input class="form-control" min="0" name="opening_balance" type="number" value="0">
                                 
                                 </div> -->
                                 <div class="form-group  clear">
                                    <label class="control-label clear">Mobile<span style="color:red;">*</span></label>
                                    <input class="form-control" required="required" name="cus_mob" type="text" value="">
                                                                    </div>    
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12 mt-4" >
                            <div class="form-group text-right">
                                <button type="submit" name ="submit" class="btn btn-sm btn-primary">Submit</button>
                                <a href="home.php"class="btn btn-sm btn-danger">Back</a>
                                
                            </div>
                        </div>
                        </form>


       </div>

            
      </main>
</section>    
</body>
</html>