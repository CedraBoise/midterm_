
<?php 
session_start();

include('../classes/order.php'); 

$orders = new Order($connection);

$order_Process = new OrderProcess($connection);

require_once '../classes/cart.php';

$cart = new Cart();
$cart_items = $cart->getItems();
$total_price = $cart->getTotalPrice();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $delivery_type = $_POST['transportMode'];
    $payment_method = $_POST['paymentMethod'];

    if (empty($customer_name) || empty($customer_address) || empty($delivery_type) || empty($payment_method)) {
        $error_message = "Please fill in all the fields.";
    } else {
        $order_id = $order_Process->createOrder($customer_name, $customer_address, $delivery_type, $payment_method, $total_price);
        $cart->clearCart();
        header("Location: ../view/view_order.php");
        exit;
    }

}

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
    <form action="" method="post" class="mt-5">
        Name: <input type="text" name="customer_name" class="mt-3">
        <br>
        Address: <input type="text" name="customer_address" class="mt-3">
        <br>
        Delivery Mode: <select name="transportMode" id="" class="mt-3">
            <option value="Delivery by Car">Delivery by Car</option>
            <option value="Delivery by Bicycle">Delivery by Bicycle</option>
            <option value="Delivery by Motorcycle">Delivery by Motorcycle</option>
        </select>
        <br>
        Payment Method: <select name="paymentMethod" id="" class="mt-3">
            <option value="Online Payment">Online Payment</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
        </select>
        <br>
</div>

<div class="container mt-3">
        <h1>Your Cart</h1>

        <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error_message) ?>
        </div>
        <?php endif; ?>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
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
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td colspan="2"><strong><?= number_format($total_price, 2) ?></strong></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="container-fluid">
        <button type="submit" class="btn btn-primary">Confirm Order</button>
        </form>
        <button onclick="returnBTN()" class="btn btn-warning text-white">Return</button>
    </div>
    </div>    
</body>
</html>

<script>

    function returnBTN(){
        window.location = 'view_cart.php';
    }
</script>
