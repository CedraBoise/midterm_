
<?php 

include('connection.php');
$GLOBALS['connection'] = $connection;



class Menu{
    private $connection;
    function __construct()
    {
        $this->connection = $GLOBALS['connection'];
    }

    public function viewMenu(){
        $menuData = $this->connection->query('SELECT * FROM menu_db');
            
        return $menuData->fetchAll(PDO::FETCH_ASSOC);
    }
}

class addMenuItem extends Menu{
    private $connection;
    function __construct()
    {
        $this->connection = $GLOBALS['connection'];
    }

    public function addItem($itemName, $itemPrice){
        $itemAdd = $this->connection->query('SELECT * FROM menu_db');
            
        return $menuData->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
