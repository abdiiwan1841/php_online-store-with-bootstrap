<?php
  $cat_id = ((isset($_REQUEST['cat']))?sanitize($_REQUEST['cat']):'');
  $price_sort = (isset($_REQUEST['price_sort'])?sanitize($_REQUEST['price_sort']):'');
  $min_price = (isset($_REQUEST['min_price'])?sanitize($_REQUEST['min_price']):'');
  $max_price = (isset($_REQUEST['max_price'])?sanitize($_REQUEST['max_price']):'');
  $b = (isset($_REQUEST['brand'])?sanitize($_REQUEST['brand']):'');
  $brandQ = $db->query("SELECT * FROM brand ORDER BY brand");
?>
<div data-spy="affix" data-offset-top="600">
<h3 class="text-center">Search By:</h3>
<h4 class="text-center">Price</h4>
<form action="search.php" method="post">
  <input type="hidden" name="cat" value="<?=$cat_id;?>">	
  <input type="hidden" name="price_sort" value="0">
  <!-- Form filtered Low to High and High to Low -->
  <!-- <div class="input-group">
    <span class="input-group-addon">
	  <input type="radio" name="price_sort" value="low"<?=(($price_sort == 'low')?' checked':'');?>>
    </span>
	<span class="input-group-addon"> Low to High</span>
  </div>
  <div class="input-group">
	<span class="input-group-addon">
	  <input type="radio" name="price_sort" value="high"<?=(($price_sort == 'high')?' checked':'');?>>
	</span>
	<span class="input-group-addon"> High to Low</span>
  </div> --> 
  <input type="radio" name="price_sort" value="low"<?=(($price_sort == 'low')?' checked':'');?>>
  Low to High <br>
  <input type="radio" name="price_sort" value="high"<?=(($price_sort == 'high')?' checked':'');?>>
  High to Low
  <br><br>
  <!-- Form filterd from Min to Max -->
  <div class="input-group">
    <input type="text" name="min_price" class="price-range form-control" placeholder="Min $" value="<?=$min_price;?>">
	To
    <input type="text" name="max_price" class="price-range form-control" placeholder="Max $" value="<?=$max_price;?>">
  </div>	
  <hr>
  <!-- From filtered by Brand -->
  <h4 class="text-center">Brand</h4>
  <div>
	<input type="radio" name="brand" value=""<?=(($b == '')?' checked':'');?>> 
	<span> All</span>
  </div>
  <?php while($brand = mysqli_fetch_assoc($brandQ)): ?>
    <div>
      <input type="radio" name="brand" value="<?=$brand['id'];?>"<?=(($b == $brand['id'])?' checked':'') ?>>
	  <span> <?=$brand['brand'];?></span>
	</div>
	<?php endwhile; ?>
  <br>
  <input type="submit" value="search" class="btn btn-sm btn-primary">
</form>
</div>