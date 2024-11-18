<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT MenuItems.name, MenuItems.price, Cart.quantity 
                        FROM Cart JOIN MenuItems ON Cart.item_id = MenuItems.item_id 
                        WHERE Cart.user_id = $user_id");

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Page Styles */
        body {
            background-color: #f5f5f5; /* Soft gray background for a clean, professional feel */
            color: #333333; /* Dark gray text for better readability */
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #34495e; /* Darker gray-blue */
            color: #fff;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: inherit !important;
        }

        .container {
            margin-top: 60px;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50; /* Darker shade for headers */
        }

        h4 {
            font-size: 1.5rem;
            color: #2980b9; /* Soft blue for total */
        }

        /* Table Styles */
        table {
            background-color: #ffffff; /* White background */
            border-radius: 10px; /* Soft rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for depth */
            margin-bottom: 30px; /* Space between table and next section */
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-size: 1rem;
        }

        th {
            background-color: #2980b9; /* Soft blue header */
            color: #fff; /* White text in headers */
        }

        td {
            background-color: #f9f9f9; /* Slightly off-white background for rows */
        }

        tr:nth-child(even) td {
            background-color: #ecf0f1; /* Light gray background for even rows */
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 1.1rem;
            color: #34495e; /* Dark gray for labels */
            font-weight: 600;
        }

        .form-control {
            border-radius: 8px; /* Soft rounded corners */
            border: 1px solid #ddd; /* Light gray border */
            padding: 10px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #2980b9; /* Blue focus border */
            box-shadow: 0 0 5px rgba(41, 128, 185, 0.5); /* Soft blue glow */
        }

        /* Button Styles */
        .btn-custom {
            background-color: #2980b9; /* Soft blue button */
            color: white;
            border: none;
            font-size: 1.2rem;
            padding: 12px 20px;
            border-radius: 5px;
            width: 100%;
        }

        .btn-custom:hover {
            background-color: #3498db; /* Slightly lighter blue on hover */
        }

        /* Adjustments for mobile screens */
        @media (max-width: 768px) {
            .container {
                margin-top: 40px;
            }

            h2 {
                font-size: 2rem;
            }

            h4 {
                font-size: 1.2rem;
            }

            th, td {
                font-size: 0.9rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td>₱<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                    </tr>
                    <?php $total_price += $row['price'] * $row['quantity']; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
        <h4>Total: ₱<?php echo number_format($total_price, 2); ?></h4>
        <form action="process_payment.php" method="POST">
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" class="form-control">
                    <option value="CreditCard">Credit Card</option>
                    <option value="CashOnDelivery">Cash on Delivery</option>
                    <option value="GCash">GCash</option>
                </select>
            </div>
            <div class="form-group">
                <label for="delivery_option">Delivery Option:</label>
                <select name="delivery_option" class="form-control">
                    <option value="Food Panda">Food Panda</option>
                    <option value="Epcst Delivery">Grab Food</option>
                </select>
            </div>
            <button type="submit" class="btn-custom">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
