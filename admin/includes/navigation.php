	<nav class="navbar navbar-default navabr-fixed-top">
		<div class = "container">
		<a href="/onlinestore/admin/index.php" class="navbar-brand">PC Hardware Store</a>
			<ul class ="nav navbar-nav">

			<!--Menu Items -->
      <li><a href="brands.php">Brands</a></li>
			<li><a href="categories.php">Categories</a></li>
			<li><a href="products.php">Products</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data['full_name'];?> !
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
				   <li><a href="change_password.php">Change Password</a></li>
					 <li><a href="logout.php">Logout</a></li>
				 </ul>
			</li>
			<!--<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category'];?><span class="caret"></span></a>
			         <ul class ="dropdown-menu role="menu">

			             <li><a href="#"></a></li>

			         </ul>
			</li>-->

		</div>
	</nav>
