<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once $_SERVER['DOCUMENT_ROOT'].'/bs_ecommerce/core/init.php';
  if(!is_logged_in()){
	header('Location: ../login.php');
  }
  // Query Cart to get product details
  $cartQuery = "SELECT items, cart_date FROM cart WHERE paid = 1";
  $cartResults = $db->query($cartQuery);
  $productData = array();
  while ($cart = mysqli_fetch_assoc($cartResults)){
	$items = json_decode($cart['items'], true);
	foreach($items as $item){
	  // Product price query
	  $itemQuery = "SELECT price, title FROM products WHERE id = '{$item['id']}'";
	  $itemResults = $db->query($itemQuery);
	  $itemResult = mysqli_fetch_assoc($itemResults);
	  $productPrice = $itemResult['price'] * $item['quantity'];
	  $productData[] = array('title' => $itemResult['title'], 'quantity' => $item['quantity'], 'sum_price' => $productPrice, 'date' => $cart['cart_date']);
	}
  }

  $data = array();
  $current = array(); 
  foreach($productData as $product){
	$date = date("Y-m-d", strtotime($product['date']));
	$title = $product['title'];
	if(!array_key_exists($date, $current)){
	  $current["$date"]["$title"]['quantity'] = $product['quantity'];
	  $current["$date"]["$title"]['sum_price'] = $product['sum_price']; 
	} else if (!array_key_exists($title, $current["$date"])) { 
	    $current["$date"]["$title"]['quantity'] = $product['quantity'];
	    $current["$date"]["$title"]['sum_price'] = $product['sum_price']; 
	  } else {		  
	      $current["$date"]["$title"]['quantity'] += $product['quantity'];
	      $current["$date"]["$title"]['sum_price'] += $product['sum_price'];
	  }
  }

  /*
  // Print Array format: ["date" => "2016-06-01", "title" =>"Levi's Jeans", "quantity" => 3, "money" => 119.97]
  $subdata = array();
  foreach($current as $date => $Arr){
	foreach($Arr as $title => $subArr){
		$j = 0;
		foreach($subArr as $key => $value){
		  $subdata[$j] = $value;
		  $j++;		  
		}
		$data[] = array('date' => $date, 'title' => $title, 'quantity' => $subdata[0], 'money' => $subdata[1]);
	}
  } 
  */
  // Print Money array only, format:  ["date" => "2016-06-01", "Levi's Jeans" => 39]
  $subdata = array();
  $i = 0;
  $t = 0;
  foreach($current as $date => $Arr){
	// Starting from 2nd data of array, check if $nextDate = $date
	if($i < 1){
	  // If $i = 0, first array data, just process
	  $data[$i]['date'] = $date;
	  foreach($Arr as $title => $subArr){
	    $j = 0;
	    foreach($subArr as $key => $value){
	      $subdata[$j] = $value;
	      $j++;		  
	    }
	    $data[$i]["$title"] = $subdata[1];
		// add all products to array[0];
		$pros = ["Levi's Jeans","Beautiful Shirts","Gorgeous Dress","Nice Purse","Pricess Dress"];
		foreach($pros as $pro){
		  if ($title !== $pro){
			$data[$i]["$pro"] = 0;
		  }
		}
	  }
	  $i++;
	} else {
		// add empty date to array
	    $preDate = strtotime($data[$i-1]['date']);
	    $nextDate = date("Y-m-d", strtotime("+1 day", $preDate));		
		while ($nextDate !== $date) {
		  $data[$i]['date'] = $nextDate;
		  $i++;
		  $preDate = strtotime($data[$i-1]['date']);
	      $nextDate = date("Y-m-d", strtotime("+1 day", $preDate));
		}
		// if $date = $nextDate
		$data[$i]['date'] = $date;
		foreach($Arr as $title => $subArr){
	      $j = 0;
	      foreach($subArr as $key => $value){
			$subdata[$j] = $value;
			$j++;		  
		  }
		  $data[$i]["$title"] = $subdata[1];
		}
		$i++;  
	    } 
  }

  mysqli_close($db);
  echo json_encode($data);
?>