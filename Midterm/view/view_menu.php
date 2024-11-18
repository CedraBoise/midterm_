
<?php 

include('../classes/menuitem.php'); 

$menu = new Menu();
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
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Price</th>
        </thead>
        <tbody>
            <?php
                $viewItems = $menu->viewMenu();

                foreach ($viewItems  as $row) {
                    echo "<tr>" . "<td>" . 
                            htmlspecialchars($row['item_id']) .
                                  "</td>" . 
                                  "<td>" . 
                            htmlspecialchars($row['item_name']) .
                                  "</td>".
                                  "<td>" . 
                            htmlspecialchars("₱" . $row['price']) .
                                  "</td>".  
                        "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div class="container-fluid">
        <button onclick="returnBTN()" class="btn btn-info text-white">Return</button>
        <button onclick="addItem()" class="btn btn-success">Add an Item</button>
    </div>

</body>
</html>

<script>
    function returnBTN(){
        window.location = '../index.php';
    }

    function addItem(){
        window.location = 'addItem.php';
    }
</script>
