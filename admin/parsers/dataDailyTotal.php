<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require_once $_SERVER['DOCUMENT_ROOT'].'/bs_ecommerce/core/init.php';
  if(!is_logged_in()){
	header('Location: ../login.php');
  }
  $txnQuery = "SELECT txn_date, grand_total FROM transactions ORDER BY txn_date";
  $txnResults = $db->query($txnQuery);
  if(!$txnResults){
	//Nope
	$message = 'Invalid query: '.$db->error."\n";
	die($message);
  }
  //Print out rows
  $data = array();
  $current = array();
  $dayTotal = 0;
  $monthTotal = 0;
  $i = 0;
  while($row = $txnResults->fetch_assoc()){
	$year = date("y",strtotime($row['txn_date']));
	$month = date("m",strtotime($row['txn_date']));
	$day = date("j",strtotime($row['txn_date']));
	$date = date("Y-M-d",strtotime($row['txn_date']));
	$row['txn_date'] = $date;
	if(!array_key_exists($date, $current)){
	  $current["$date"] = $row['grand_total'];
	} else { $current["$date"] += $row['grand_total']; }
	
  }
  foreach($current as $key => $key_value){
	/*  
	$data[$i]['txn_date'] = $key;
	$data[$i]['grand_total'] = $key_value;
	$i++; */
	$data[] = array('txn_date' => $key, 'grand_total' => $key_value); 
  }

  mysqli_close($db);
  echo json_encode($data);
?>