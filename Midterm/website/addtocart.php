<?php
session_start();
require_once 'Cart.php';

include('connection.php');
$GLOBALS['connection'] = $connection;

$cart = new Cart();
$item_id = $_GET['itemNo'] ?? null;

if ($item_id) {
    // Prepare a statement to fetch item details
    $stmt = $connection->prepare("SELECT * FROM menu_db WHERE item_id = :item_id");
    $stmt->execute(['item_id' => $item_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $cart->addItem($item['item_id'], $item['item_name'], $item['price']);
    }
}

header("Location: ../view/view_cart.php");
exit;
?>
