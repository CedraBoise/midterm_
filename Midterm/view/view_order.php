
<?php 

include('../classes/order.php'); 

$orders = new Order($connection); 

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
    <table class='table table-hover' border='1'>
        <thead>
            <th>Order ID</th>
            <th>Delivery Type</th>
            <th>Payment Method</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
        </thead>
        <tbody>
        <?php
                $viewOrders = $orders->orderData();

                foreach ($viewOrders as $row) {
                    echo "<tr>" . "<td>" . 
                            htmlspecialchars($row['order_id']) .
                                  "</td>" . 
                                  "<td>" . 
                            htmlspecialchars($row['delivery_type']) .
                                  "</td>".
                                  "<td>" . 
                            htmlspecialchars($row['payment_method']) .
                                  "</td>". 
                                  "<td>" . 
                            htmlspecialchars($row['customer_name']) .
                                  "</td>".
                                  "<td>" . 
                            htmlspecialchars($row['customer_address']) .
                                  "</td>".   
                        "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div class="container-fluid">
        <button onclick="returnBTN()" class="btn btn-info">Return</button>
    </div>


</body>
</html>

<script>
    function returnBTN(){
        window.location = '../index.php';
    }
</script>
