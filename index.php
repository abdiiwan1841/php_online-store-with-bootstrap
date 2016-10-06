<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once 'core/init.php';
  include 'includes/head.php'; 
  include 'includes/navigation.php';	
  include 'includes/headerfull.php';
  include 'includes/leftbar.php';
  
  $sql = "SELECT * FROM products WHERE featured = 1 AND deleted = 0";
  $featured = $db->query($sql);
?>

  <!-- Main Content -->
  <div class="col-md-8">
    <div class="container-fluid">
    <div class="row">
	  <h2 class="text-info text-center">Feature Products</h2>
	  <?php while($product = mysqli_fetch_assoc($featured)) : 
	  // var_dump($product); <!-- check returned result --> ?>
		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
			  <div class="caption">
			  <h4><?= $product['title']; ?></h4>
			  <?php $photos = explode(',',$product['image']); ?>
			  <img src="<?=$photos[0];?>" alt="<?= $product['title']; ?>" class="img-thumb" />
			  <?php if($product['list_price'] != 0): ?>
			  <p class="list-price text-danger">List Price: <s>$<?= $product['list_price']; ?></s></p>
			  <?php else: ?>
			    <p class="list-price text-danger">List Price:</p>
			  <?php endif; ?>
			  <p class="price">Our Price: $<?= $product['price']; ?></p>
			  <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['id']; ?>)">Details</button>
		      </div>
			</div>
		  </div>
	  <?php endwhile; ?>			  
	</div>
	</div>
  </div>

<?php 
 include 'includes/rightbar.php';
 include 'includes/footer.php';
?> 

