
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
            <th>Item Name</th>
            <th>Price</th>
            <th></th>
        </thead>
        <tbody>
            <form action="" method="post">
                <tr>
                    <td>
                    <input type="text" name="itemName">
                    </td>
                    <td>
                    <input type="text" name="itemPrice">
                    </td>
                    <td>
                    <input class="btn btn-success rounded text-white" type="submit" value="Add">    
                    </td>
                </tr>
            </form>
        </tbody>
    </table>

    <div class="container-fluid">
        <button onclick="cancel()" class="btn btn-danger">Cancel</button>
    </div>

</body>
</html>

<script>
    function cancel(){
        window.location = 'view_menu.php';
    }
</script>
