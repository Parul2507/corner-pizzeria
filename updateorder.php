<?php
include "header.php";
include "checksession.php";
include "menu.php";
include "config.php";

$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

$id = $_POST['orderid'];
$query = "delete from orderlines where orderID=$id";
$result = mysqli_query($DBC,$query);
$query = "delete from orders where orderID=$id";
$result = mysqli_query($DBC,$query);

$query = 'SELECT itemID,price FROM fooditems ORDER BY pizzatype';
$pizza = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($pizza); 
$totalPrice = 0.0;
$order_id = $id;
$userid = $_POST["userid"];
$current_time = $_POST["order_date"];
$delivary_time = $_POST["delivary_time"];
$item_id = [];

while ($row = mysqli_fetch_assoc($pizza)) {
    $id = $row['itemID'];	
    $price = $row['price'];
    if(in_array($id, $_POST)){
        $totalPrice += $price;
        $item_id[] = $id;
    }
}
$query = "insert into orders (orderID, customerID, orderDatetime, delivaryDate, orderCost) values ($order_id, $userid, '$current_time', '$delivary_time', $totalPrice)";
$result = mysqli_query($DBC,$query);
foreach($item_id as $id){
    $query = "insert into orderlines (orderID, itemID) values ($order_id, $id)";
    $result = mysqli_query($DBC,$query);
}

echo "<h1>Order #$order_id updated.</h1>";     
echo "<h2><a href='listorders.php'>[Return to order list page]</a><a href='index.php'>[Return to main page]</a></h2>";

include "footer.php"; ?>  
