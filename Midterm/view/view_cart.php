
<?php 

include('../classes/menuitem.php');

$menu = new Menu();

session_start();
require_once '../classes/cart.php';

$cart = new Cart();
$cart_items = $cart->getItems();
$total_price = $cart->getTotalPrice();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>

    <div class="container">
        <h1>Menu List</h1>
        <table class='table table-hover' border='1'>
            <thead>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    $viewItems = $menu->viewMenu();
    
                    foreach($viewItems  as $row){
            
                    ?>
                                <tr>
                                        <td><?php echo htmlspecialchars($row['item_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                                        <td><a class="btn btn-success" href="../classes/addtocart.php?itemNo=<?php echo urlencode($row['item_id']);?>">Add to Cart</a> </td>
                                </tr>
            
                    <?php
                        }
                    ?>
                
            </tbody>
        </table>
    </div>

    <div class="container">
        <h1>Your Cart</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($cart_items): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['item_name']) ?></td>
                            <td><?= number_format($item['price'], 2) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td><?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            <td>
                                <a class="btn btn-danger" href="../classes/removeitem.php?itemNo=<?= urlencode($item['item_id']) ?>">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4"><strong>Total</strong></td>
                        <td colspan="2"><strong><?= number_format($total_price, 2) ?></strong></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="../classes/clearCart.php" class="btn btn-danger">Clear Cart</a>
        <?php if ($cart_items): ?>
        <a href="order_processing.php" class="btn btn-primary">Confirm Order</a>
        <?php endif; ?>
    </div>    

    <div class="container pt-5">
        <button onclick="returnBTN()" class="btn btn-warning text-white">Return</button>
    </div>

</body>
</html>

<script>
    function returnBTN(){
        window.location = '../index.php';
    }
</script>
