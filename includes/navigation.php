<?php
require_once 'core/init.php';
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
?>  

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
	  <a href="index.php" class="navbar-brand">Beauty's Boutique</a> 
	</div>
	  <div class="collapse navbar-collapse" id="collapsemenu">
	    <ul class="nav navbar-nav">
		  <?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
		    <?php 
			  $parent_id = $parent['id']; 
			  $sql2 = "SELECT * FROM categories WHERE parent = $parent_id";  
			  $cquery = $db->query($sql2);
			?>
		    <!-- Menu Items -->
			  <li class="dropdown">
				<a id="dLabel" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $parent['category']; ?><span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				  <?php while($child = mysqli_fetch_assoc($cquery)) : ?>
				  <li><a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category']; ?></a></li>
				  <?php endwhile; ?>
				</ul>
			  </li>
		  <?php endwhile; ?>
		  <?php 
		    $cartQ = $db->query("SELECT * FROM cart WHERE id ='$cart_id'");
			$cartResult = mysqli_fetch_assoc($cartQ);
		    $cartArray = json_decode($cartResult['items'], true);
			$cartCount = count($cartArray);
		  ?>		  
		  <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart (<?=$cartCount;?>)</a></li>
	    </ul>
	  </div>
  </div>
</nav>