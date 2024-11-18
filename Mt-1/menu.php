<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
}

$user_id = $_SESSION['user_id'];

$menu_result = $conn->query("SELECT * FROM MenuItems");

$cart_result = $conn->query("SELECT MenuItems.name, MenuItems.price, Cart.quantity 
                             FROM Cart 
                             JOIN MenuItems ON Cart.item_id = MenuItems.item_id 
                             WHERE Cart.user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Menu</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">   

  <style>
    body {
      background-color: #e2f0ff; /* Cool white */
      color: #2c3e50; /* Dark blue */
      font-family: sans-serif;
    }

    .navbar {
      background-color: #428bca; /* Light blue */
      color: #fff; /* White */
    }

    .navbar-brand, .navbar-nav .nav-link {
      color: inherit !important;
    }

    .menu-section {
      margin-bottom: 30px; /* Add bottom margin to the menu section */
    }

    .menu-item .card {
      border: none;
      background-color: #fff; /* White */
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
      margin-bottom: 20px;
      border-radius: 5px; /* Rounded corners */
    }

    .menu-item .btn-primary {
      background-color: #428bca; /* Light blue */
      border-color: #428bca;
      color: #fff; /* White */
    }

    .menu-item .btn-primary:hover {
      background-color: #357ebd; /* Darker blue on hover */
    }

    /* Cart Section: Increase height and width */
    .cart-section {
      background-color: #fff; /* White */
      border-radius: 5px; /* Rounded corners */
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      border: 1px solid #ddd; /* Light border */
      margin-top: 30px;
      min-height: 400px; /* Make cart taller */
      max-width: 350px; /* Adjust width */
    }

    .btn-success {
      background-color: #428bca; /* Light blue */
      border-color: #428bca;
      color: #fff; /* White */
    }

    .btn-success:hover {
      background-color: #357ebd; /* Darker blue on hover */
    }

    h2, h4 {
      font-weight: bold;
      color: #2c3e50; /* Dark blue */
    }

    .container {
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* Full viewport height */
    }

    /* Menu Section */
    .menu-section-wrapper {
      flex: 1; /* Allow the menu section to fill available space */
      display: flex;
      flex-wrap: wrap; /* Allow wrapping of items */
      justify-content: flex-start; /* Align items to the left */
    }

    .menu-item {
      flex: 1 1 30%; /* 3 items per row, and they should grow and shrink equally */
      margin: 10px; /* Space between items */
    }

    /* Ensure the cart section stays at the bottom */
    .cart-section {
      order: 2; /* Ensure cart section is at the bottom */
    }

    /* For better responsive design, adjust items per row */
    @media (max-width: 768px) {
      .menu-item {
        flex: 1 1 45%; /* 2 items per row on smaller screens */
      }
    }

    @media (max-width: 480px) {
      .menu-item {
        flex: 1 1 100%; /* 1 item per row on very small screens */
      }
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <!-- Menu Section -->
    <div class="row menu-section-wrapper">
      <div class="col-md-8">
        <h2>Menu</h2>
        <div class="text-center">
          <h1>On Cloud Steak House</h1>
        </div>
        <div class="row">
          <?php while ($row = $menu_result->fetch_assoc()): ?>
            <div class="col-md-4 menu-item">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['name']; ?></h5>
                  <p class="card-text">₱<?php echo number_format($row['price'], 2); ?></p>
                  <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                  </form>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>

    <!-- Cart Section -->
    <div class="col-md-4 cart-section">
      <h4>Cart</h4>
      <?php if ($cart_result->num_rows > 0): ?>
        <ul class="list-group">
          <?php 
          $total = 0; 
          while ($cart_item = $cart_result->fetch_assoc()): 
            $total += $cart_item['price'] * $cart_item['quantity'];
          ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo $cart_item['name']; ?>
              <span>₱<?php echo number_format($cart_item['price'] * $cart_item['quantity'], 2); ?></span>
            </li>
          <?php endwhile; ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Total</strong>
            <span>₱<?php echo number_format($total, 2); ?></span>
          </li>
        </ul>
        <a href="checkout.php" class="btn btn-success btn-block mt-3">Proceed to Checkout</a>
      <?php else: ?>
        <p>Your cart is empty.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
