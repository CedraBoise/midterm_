<?php
session_start();
require_once 'cart.php';

$cart = new Cart();
$item_id = $_GET['itemNo'] ?? null;

if ($item_id) {
    $cart->removeItem($item_id);
}

header("Location: ../view/cart.php");
exit;
?>
