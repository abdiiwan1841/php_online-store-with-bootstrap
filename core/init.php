<?php
$db = mysqli_connect('localhost','root','','bs_ecommerce');
if(mysqli_connect_errno()) {
  echo 'Database connection failed with following error: '. mysqli_connect_error();
  die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/bs_ecommerce/config.php';
require_once BASEURL.'helpers/helpers.php';
require BASEURL.'vendor/autoload.php';

$cart_id = '';
if(isset($_COOKIE[CART_COOKIE])){
  $cart_id = sanitize($_COOKIE[CART_COOKIE]);
}

if(isset($_SESSION['SBUser'])){
  $user_id = $_SESSION['SBUser'];
  $query = $db->query("SELECT * FROM users WHERE id='$user_id'");
  $user_data = mysqli_fetch_assoc($query);
  $fn = explode(' ',$user_data['full_name']);
  $user_data['first'] = $fn[0];
  if(!empty($fn[1])){$user_data['last'] = $fn[1];}
}

if(isset($_SESSION['success_flash'])){
  echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
  unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash'])){
  echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
  unset($_SESSION['error_flash']);
}


