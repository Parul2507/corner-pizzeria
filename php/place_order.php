<?php
include "header.php";
include "checksession.php";
include "menu.php";

include "config.php"; //load in any variables
$DBC = mysqli_connect(DBHOSTNAME, DBUSER, DBPASSWORD, DBDATABASE);

if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

$query = 'SELECT itemID,price FROM fooditems ORDER BY pizzatype';
$pizza = mysqli_query($DBC,$query);
$rowcount = mysqli_num_rows($pizza); 
$totalPrice = 0.0;
$order_id = rand(10000, 99999);
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

echo "<h1>Order Placed</h1>";

mysqli_close($DBC); //close the connection once done

include "footer.php"; ?>  

