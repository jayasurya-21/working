<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style.css">
	<title>Admin Dashboard</title>
</head>
<body>
	

	
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="home.php" class="brand" class="text-decoration-none"><i class='bx bxs-smile icon'></i>ASIAN TRADERS</a>
		<ul class="side-menu">
			<li><a href="home.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			
			<li>
				<a href="#"><i class='bx bxs-inbox icon' ></i> PRODUCT <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="add_product.php">ADD PRODUCT</a></li>
					<li><a href="list_product.php">VIEW PRODUCTS</a></li>
					<li><a href="inventory.php">INVENTORY</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-inbox icon' ></i> SALES <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="sale.php">CREATE INVOICE</a></li>
					<li><a href="sale_return.php">SALES RETURN</a></li>
					
				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-inbox icon' ></i> PURCHASE <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="new_purchase.php">NEW PURCHASE</a></li>
					<li><a href="purchase_return.php">PURCHASE RETURN</a></li>
					
				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-inbox icon' ></i> SUPPLIERS <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="add_supplier.php">ADD SUPPLIERS</a></li>
					<li><a href="list_supplier.php">VIEW SUPPLIERS</a></li>
					
				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-inbox icon' ></i> CUSTOMERS <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="add_customer.php">ADD CUSTOMER</a></li>
					<li><a href="list_customer.php">VIEW CUSTOMER</a></li>
					
				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-inbox icon' ></i> REPORTS <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="sales_report.php" >SALE</a></li>
					<li><a href="purchase_report.php">PURCHASE</a></li>
					<li><a href="sales_return_report.php">SALES RETURN</a></li>
					<li><a href="purchase_return_report.php">PURCHASE RETURN</a></li>
				</ul>
			</li>
			<!-- <li><a href="#"><i class='bx bxs-chart icon' ></i> Charts</a></li>
			<li><a href="#"><i class='bx bxs-widget icon' ></i> Widgets</a></li>
			<li class="divider" data-text="table and forms">Table and forms</li>
			<li><a href="#"><i class='bx bx-table icon' ></i> Tables</a></li>
			<li>
				<a href="#"><i class='bx bxs-notepad icon' ></i> Forms <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="#">Basic</a></li>
					<li><a href="#">Select</a></li>
					<li><a href="#">Checkbox</a></li>
					<li><a href="#">Radio</a></li>
				</ul>
			</li> -->
		<!-- </ul>
		<div class="ads">
			<div class="wrapper">
				<a href="#" class="btn-upgrade">Upgrade</a>
				<p>Become a <span>PRO</span> member and enjoy <span>All Features</span></p>
			</div>
		</div> -->
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>

			<i class='bx bx-menu toggle-sidebar' ></i>
			 
			
			

			
			<!-- <form action="#">
				<div class="form-group 1">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</form> -->
			<!-- <a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a> -->
			<span class="divider"></span>
			<div class="profile">
				<img src="admin.png" alt="">
				<ul class="profile-link">
					<li><a href="add_user.php"><i class='bx bxs-user-circle icon' ></i> add user</a></li>
					<li><a href="change_password.php"><i class='bx bxs-cog' ></i> change password</a></li>
					<li><a href="logout.php"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		
	</section>
	<!-- NAVBAR -->

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="script.js"></script>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggles = document.querySelectorAll('.side-menu > li > a');

    dropdownToggles.forEach(function(dropdownToggle) {
        dropdownToggle.addEventListener('click', function(event) {
            event.preventDefault();
            const parent = this.parentElement;
            const isActive = parent.classList.contains('active');

            // Toggle the active class for the clicked dropdown
            parent.classList.toggle('active');
        });
    });
});
   



	</script>
</body>
</html>