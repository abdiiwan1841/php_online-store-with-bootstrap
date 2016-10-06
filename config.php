<?php
define ('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/bs_ecommerce/');
define ('CART_COOKIE','SBwi12KJKDScnkdde12');
define ('CART_COOKIE_EXPIRE',time() + (86400 *30));
define ('TAXRATE', 0.05); //Sales tax rate. Set to 0 if you aren't charging tax.

define ('CURRENCY', 'usd');
define ('CHECKOUTMODE', 'TEST'); //Change TEST to LIVE when you are ready to go LIVE.

if(CHECKOUTMODE == 'TEST'){ 
  define('STRIPE_PRIVATE','sk_test_V1xL12URBMWZLpaPAWGQM6O6');
  define('STRIPE_PUBLIC','pk_test_3uy6McVRkspA3QwvBKXEmmS0');
}

if(CHECKOUTMODE == 'LIVE'){ 
  define('STRIPE_PRIVATE','');
  define('STRIPE_PUBLIC','');
}
?>