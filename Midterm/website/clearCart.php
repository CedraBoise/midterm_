<?php
session_start();
require_once 'cart.php';

$cart = new Cart();
$cart->clearCart();

header("Location: ../view/view_cart.php");
exit;
?>
