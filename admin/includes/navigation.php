<!-- Top Nav Bar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsemenu" aria-expanded="false">
	    <span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	    <a href="/bs_ecommerce/admin/index.php" class="navbar-brand">Beauty's Boutique Admin</a> 	 
	</div>
	  <div class="collapse navbar-collapse" id="collapsemenu">
	    <ul class="nav navbar-nav">
		    <!-- Menu Items -->
			<li><a href="index.php">My Dashboard</a></li>
			<li><a href="insight.php">Insight</a></li>
			<li><a href="brands.php">Brands</a></li>
			<li><a href="categories.php">Categories</a></li>		
			<li><a href="products.php">Products</a></li>	
			<li><a href="archived.php">Archived</a></li>	
			<?php if(has_permission('admin')): ?>
			<li><a href="users.php">Users</a></li>				
			<?php endif; ?>			
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data['first'];?>!
			  <span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
			    <li><a href="change_password.php">Change Password</a></li>
				<li><a href="logout.php">Log Out</a></li>
			  </ul>
			</li>	 
			<!-- <li class="dropdown">
				<a id="dLabel" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $parent['category']; ?><span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				  <li><a href="#"></a></li>
				</ul>
			  </li> -->
	    </ul>
	  </div>
	</div>
</nav>
<div class="container-fluid">