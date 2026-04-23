<?php
require("stripe-php-master/init.php");

$Publishablekey = "YOUR_STRIPE_PUBLISHABLE_KEY";

$Secretkey = "YOUR_STRIPE_SECRET_KEY";

\Stripe\Stripe::setApiKey($Secretkey);
?>