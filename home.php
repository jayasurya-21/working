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
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="home.php">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>
            
            <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                        <div class="card" style="width: 18rem; height: 22rem">
                            <img class="card-img-top" src="limit.jpg" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title" style="margin-top: 65px;">LIMIT EXCEEDED</h5>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                            <a href="stock_limit_product.php" class="btn btn-primary">Check</a>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="EXPIRING.jpg" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">EXPIRES SOON</h5>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                            <a href="expiring_products.php" class="btn btn-primary">Check</a>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="card" style="width: 18rem; height: 22rem">
                            <img class="card-img-top" src="limit.jpg" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title" style="margin-top: 65px;">LIMIT EXCEEDED</h5>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                            <a href="#" class="btn btn-primary">Check</a>
                            </div>
                        </div>
                        </div>




 

            
      </main>
</section>    
</body>
</html>
