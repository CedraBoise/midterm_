<?php
session_start();
include('db_connection.php');

if (isset($_POST['item_id'])) {
  $user_id = $_SESSION['user_id'];
  $item_id = $_POST['item_id'];

  $sql = "INSERT INTO Cart (user_id, item_id, quantity) VALUES ($user_id, $item_id, 1)"; // Assuming quantity starts at 1

  if ($conn->query($sql) === TRUE) {
    // Successful insertion
    header('Location: menu.php'); // Redirect back to menu.php
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else {
  // Handle invalid request
  echo "Error adding to cart.";
}
?>